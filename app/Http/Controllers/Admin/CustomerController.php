<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $customers = Customer::select('customers.*');

            return DataTables::of($customers)
                ->addIndexColumn()
                ->addColumn('status', function ($customer) {
                    if ($customer->status == 'ACTIVE') {
                        return '<span class="badge bg-success">ACTIVE</span>';
                    } else {
                        return '<span class="badge bg-secondary">INACTIVE</span>';
                    }
                })
                ->editColumn('created_at', fn($customer) => $customer->created_at->format('M d, Y'))
                ->addColumn('action', function ($customer) {
                    $show   = '<a href="' . route('admin.customers.show', $customer->id) . '" class="btn btn-sm btn-outline-info me-1">View</a>';
                    $edit   = '<a href="' . route('admin.customers.edit', $customer->id) . '" class="btn btn-sm btn-outline-danger me-1">Edit</a>';
                    $delete = '<form method="POST" action="' . route('admin.customers.destroy', $customer->id) . '" style="display:inline-block;">'
                    . csrf_field()
                    . method_field('DELETE')
                        . '<button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm(\'Are you sure?\');">Delete</button>'
                        . '</form>';

                    return $show . ' ' . $edit . ' ' . $delete;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('admin.customers.index');
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name'  => 'required|string|max:255',
            'phone'          => 'nullable|string|max:20',
            'status'         => 'required|string',
            'company_name'   => 'nullable|string|max:255',
            'address'        => 'nullable|array',
            'description'    => 'nullable|string',
            'contact_source' => 'nullable|string|max:255',
            'email'          => 'nullable|string|email|max:255',
            'gst_no'         => 'nullable|string|max:255',
        ]);

        $data = $request->all();

        if ($request->has('address')) {
            $data['address'] = $request->address;
        }

        Customer::create($data);

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer created successfully.');
    }

    public function show(Customer $customer)
    {
        return view('admin.customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'customer_name'  => 'required|string|max:255',
            'phone'          => 'nullable|string|max:20',
            'status'         => 'required|string',
            'company_name'   => 'nullable|string|max:255',
            'address'        => 'nullable|array',
            'description'    => 'nullable|string',
            'contact_source' => 'nullable|string|max:255',
            'email'          => 'nullable|string|email|max:255',
            'gst_no'         => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        if ($request->has('address')) {
            $data['address'] = $request->address;
        }

        $customer->update($data);

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer deleted successfully.');
    }

    public function exportCsv()
    {
        $fileName  = 'customers.csv';
        $customers = \App\Models\Customer::all();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0",
        ];

        $columns = ['Name', 'Phone', 'Status', 'Company',"Email", "GST No", 'Address', 'Contact Source', 'description', 'updated_at', 'created_at'];

        $callback = function () use ($customers, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($customers as $customer) {
                fputcsv($file, [
                    $customer->customer_name,
                    $customer->phone,
                    $customer->status,
                    $customer->company_name,
                    $customer->email,
                    $customer->gst_no,
                    // if address is JSON array, join it into a string
                    is_array($customer->address) ? implode(', ', $customer->address) : $customer->address,
                    $customer->contact_source,
                    $customer->description,
                    $customer->updated_at,
                    $customer->created_at,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

}
