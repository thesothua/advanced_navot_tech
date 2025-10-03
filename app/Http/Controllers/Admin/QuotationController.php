<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = Quotation::with('customer')->latest()->paginate(15);
        return view('admin.quotations.index', compact('quotations'));
    }

    public function create()
    {
        $customers = Customer::orderBy('company_name')->get();
        $products = Product::orderBy('name')->get();
        $nextNumber = 'Q' . now()->format('Ymd') . '-' . str_pad((Quotation::count() + 1), 4, '0', STR_PAD_LEFT);
        return view('admin.quotations.create', compact('customers', 'products', 'nextNumber'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => ['required', Rule::exists('customers', 'id')],
            'quotation_no' => ['required', 'string', 'max:50', 'unique:quotations,quotation_no'],
            'quotation_date' => ['required', 'date'],
            'currency' => ['required', 'string', 'max:10'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['nullable', Rule::exists('products', 'id')],
            'items.*.product_name' => ['required', 'string'],
            'items.*.gst_percent' => ['nullable', 'numeric'],
            'items.*.price' => ['required', 'numeric'],
            'items.*.quantity' => ['required', 'numeric'],
            'items.*.discount_type' => ['required', Rule::in(['percent','amount'])],
            'items.*.discount_value' => ['nullable', 'numeric'],
            'items.*.amount' => ['required', 'numeric'],
        ]);

        return DB::transaction(function () use ($validated) {
            $quotation = Quotation::create([
                'customer_id' => $validated['customer_id'],
                'quotation_no' => $validated['quotation_no'],
                'quotation_date' => $validated['quotation_date'],
                'currency' => $validated['currency'],
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
                    'product_name' => $item['product_name'],
                    'product_code' => $item['product_code'] ?? null,
                    'hsn_sac_code' => $item['hsn_sac_code'] ?? null,
                    'make' => $item['make'] ?? null,
                    'guarantee' => $item['guarantee'] ?? null,
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

    // Lightweight endpoints to support autofill
    public function productDetails(Product $product)
    {
        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'price' => (float)$product->price,
            'sku' => $product->sku,
        ]);
    }
}

