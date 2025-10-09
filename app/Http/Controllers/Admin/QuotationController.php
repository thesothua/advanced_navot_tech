<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = Quotation::with('customer')->latest()->paginate(15);
        return view('admin.quotations.index', compact('quotations'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();
        $nextNumber = $this->generateQuotationNo('QT-');
        $settings = app(\App\Settings\GeneralSettings::class);
        $availableTerms = $settings->terms_and_conditions ?? [];
        
        return view('admin.quotations.create', compact('products', 'nextNumber', 'availableTerms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => ['nullable', Rule::exists('customers', 'id')],
            'customer_name' => ['required_without:customer_id', 'nullable', 'string', 'max:255'],
            'customer_email' => ['nullable', 'email', 'max:255'],
            'customer_gst_no' => ['nullable', 'string', 'max:255'],
            'customer_street' => ['nullable', 'string', 'max:255'],
            'customer_city' => ['nullable', 'string', 'max:255'],
            'customer_state' => ['nullable', 'string', 'max:255'],
            'customer_zip' => ['nullable', 'string', 'max:20'],
            'customer_country' => ['nullable', 'string', 'max:255'],
            'quotation_date' => ['required', 'date'],
            'currency' => ['required', 'string', 'max:10'],
            'make' => ['nullable', 'string', 'max:255'],
            'quotation_no' => ['required', 'string', 'max:255', Rule::unique('quotations', 'quotation_no')],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['nullable', Rule::exists('products', 'id')],
            'items.*.category_id' => ['nullable', 'exists:categories,id'],
            // 'items.*.product_name' => ['required', 'string'],
            'items.*.product_code' => ['nullable', 'string', 'max:255'],
            'items.*.description' => ['nullable', 'string'],
            'items.*.gst_percent' => ['nullable', 'numeric'],
            'items.*.price' => ['required', 'numeric'],
            'items.*.quantity' => ['required', 'numeric'],
            'items.*.discount_type' => ['required', Rule::in(['percent','amount'])],
            'items.*.discount_value' => ['nullable', 'numeric'],
            'items.*.amount' => ['required', 'numeric'],
            'selected_terms_and_conditions' => ['nullable', 'array'],
        ]);

        // dd($validated);

        return DB::transaction(function () use ($validated) {
            $quotation = Quotation::create([
                'customer_id' => $validated['customer_id'],
                'customer_name' => $validated['customer_name'] ?? null,
                'customer_email' => $validated['customer_email'] ?? null,
                'customer_gst_no' => $validated['customer_gst_no'] ?? null,
                'customer_street' => $validated['customer_street'] ?? null,
                'customer_city' => $validated['customer_city'] ?? null,
                'customer_state' => $validated['customer_state'] ?? null,
                'customer_zip' => $validated['customer_zip'] ?? null,
                'customer_country' => $validated['customer_country'] ?? null,
                'selected_terms_and_conditions' => $validated['selected_terms_and_conditions'] ?? null,
                'quotation_no' => $validated['quotation_no'],
                'quotation_date' => $validated['quotation_date'],
                'currency' => $validated['currency'],
                'make' => $validated['make'] ?? null,
                'subtotal' => 0,
                'total_gst' => 0,
                'total_discount' => 0,
                'grand_total' => 0,
            ]);

            $subtotal = 0; $totalGst = 0; $totalDiscount = 0; $grandTotal = 0;

            foreach ($validated['items'] as $item) {
                $discountAmount = $item['discount_type'] === 'percent'
                    ? ($item['price'] * $item['quantity']) * ((float)($item['discount_value'] ?? 0) / 100)
                    : (float)($item['discount_value'] ?? 0);
                $lineBase = ($item['price'] * $item['quantity']) - $discountAmount;
                $gstAmount = $lineBase * ((float)($item['gst_percent'] ?? 0) / 100);
                $amount = $lineBase + $gstAmount;

                $quotation->items()->create([
                    'product_id' => $item['product_id'] ?? null,
                    'category_id' => $item['category_id'] ?? null,
                    // 'product_name' => $item['product_name'],
                    'product_code' => $item['product_code'] ?? null,
                    // 'guarantee' => $item['guarantee'] ?? null,
                    'description' => $item['description'] ?? null,
                    'gst_percent' => $item['gst_percent'] ?? 0,
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'discount_type' => $item['discount_type'],
                    'discount_value' => $item['discount_value'] ?? 0,
                    'amount' => $amount,
                ]);

                $subtotal += ($item['price'] * $item['quantity']);
                $totalDiscount += $discountAmount;
                $totalGst += $gstAmount;
                $grandTotal += $amount;
            }

            $quotation->update([
                'subtotal' => $subtotal,
                'total_gst' => $totalGst,
                'total_discount' => $totalDiscount,
                'grand_total' => $grandTotal,
            ]);

            return redirect()->route('admin.quotations.show', $quotation)->with('success', 'Quotation created');
        });
    }

    public function show(Quotation $quotation)
    {
        $quotation->load('customer', 'items');
        return view('admin.quotations.show', compact('quotation'));
    }

    public function revise(Quotation $quotation)
    {
        $products = Product::orderBy('name')->get();
        $settings = app(\App\Settings\GeneralSettings::class);
        $availableTerms = $settings->terms_and_conditions ?? [];
        
        // Duplicate the quotation attributes, but unset id and quotation_no
        $revisedQuotation = $quotation->replicate();
        $revisedQuotation->quotation_no = $this->generateQuotationNo('RQT-', $quotation); // Generate new quotation number
        $revisedQuotation->quotation_date = now()->toDateString(); // Set current date
        $revisedQuotation->setRelation('items', $quotation->items->map(function ($item) {
            return $item->replicate();
        }));

        return view('admin.quotations.edit', [
            'quotation' => $revisedQuotation,
            'products' => $products,
            'availableTerms' => $availableTerms,
            'isRevising' => true, // Flag to indicate we are in revise mode
        ]);
    }

    public function edit(Quotation $quotation)
    {
        // Redirect to revise functionality, as direct editing is not allowed
        return redirect()->route('admin.quotations.revise', $quotation);
    }

    public function update(Request $request, Quotation $quotation)
    {
        // This method will no longer be used for direct updates.
        // The revise method will handle creating new quotations based on existing ones.
        abort(403, 'Unauthorized action. Quotations cannot be directly updated, only revised.');
    }

    // Lightweight endpoints to support autofill
    public function productDetails(Product $product)
    {
        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'price' => (float)$product->price,
            'sku' => $product->sku,
            'brand' => $product->brand?->name,
            'brand_id' => $product->brand?->id,
            'description' => $product->description,
            'category_id' => $product->categories()->pluck('categories.id')->first(),
        ]);
    }

    public function customersAutocomplete(Request $request)
    {
       
        $q = trim((string)$request->get('q', ''));
        if ($q === '') {
            return response()->json([]);
        }
        $names = Customer::whereNotNull('company_name')
            ->where('company_name', 'like', "%{$q}%")
            ->select('company_name')
            ->distinct()
            ->orderBy('company_name')
            ->limit(10)
            ->pluck('company_name');
        return response()->json($names);
    }

    public function getCustomerDetails(Request $request)
    {
        $id = $request->get('id');
        $company = $request->get('company');

        $customer = null;
        if ($id) {
            $customer = Customer::find($id);
        } elseif ($company) {
            $customer = Customer::where('company_name', $company)->first();
        }
        if (!$customer) {
            return response()->json(['message' => 'Not found'], 404);
        }
        $address = $customer->address ?? [];
        return response()->json([
            'id' => $customer->id,
            'company_name' => $customer->company_name,
            'customer_name' => $customer->customer_name,
            'email' => $customer->email ?? null,
            'gst_no' => $customer->gst_no ?? null,
            'address' => [
                'street' => $address['street'] ?? null,
                'city' => $address['city'] ?? null,
                'state' => $address['state'] ?? null,
                'zip' => $address['zip'] ?? null,
                'country' => $address['country'] ?? null,
            ],
        ]);
    }

    public function download(Quotation $quotation)
    {
        $quotation->load('customer', 'items');
        
        $pdf = Pdf::loadView('admin.quotations.pdf', compact('quotation'));
        
        $filename = 'Quotation_' . $quotation->quotation_no . '_' . $quotation->quotation_date->format('Y-m-d') . '.pdf';
        
        return $pdf->download($filename);
    }

    public function preview(Quotation $quotation)
    {
        $quotation->load('customer', 'items');
        
        $pdf = Pdf::loadView('admin.quotations.pdf', compact('quotation'));
        
        return $pdf->stream('Quotation_' . $quotation->quotation_no . '.pdf');
    }

    private function generateQuotationNo(string $prefix = 'QT-', ?Quotation $originalQuotation = null): string
    {
        $lastNumber = 0;

        if ($originalQuotation && str_starts_with($originalQuotation->quotation_no, 'QT-')) {
            // Extract the number part from the original QT-XXXX
            $parts = explode('-', $originalQuotation->quotation_no);
            if (count($parts) === 2 && is_numeric($parts[1])) {
                $lastNumber = (int)$parts[1];
            }
        } else {
            // Find the latest number for the given prefix
            $latestQuotation = Quotation::where('quotation_no', 'like', $prefix . '%')
                ->orderByDesc('quotation_no')
                ->first();

            if ($latestQuotation) {
                $parts = explode('-', $latestQuotation->quotation_no);
                if (count($parts) === 2 && is_numeric($parts[1])) {
                    $lastNumber = (int)$parts[1];
                }
            }
        }

        $nextNumber = $lastNumber + 1;
        return $prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }
}
