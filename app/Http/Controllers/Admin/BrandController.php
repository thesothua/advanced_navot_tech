<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $brands = Brand::with(['media'])->withCount('products')->select('brands.*');

            return DataTables::of($brands)
                ->addIndexColumn()
                ->addColumn('logo', function ($brand) {
                    $media = $brand->getFirstMedia('logos');

                    if (! $media) {
                        return '<img src="https://via.placeholder.com/50x50?text=No+Logo" alt="no logo" width="50" height="50" class="rounded">';
                    }

                    $url = $media->getUrl();
                    return '<img src="' . $url . '" alt="' . e($brand->name ?? 'Brand') . '" width="50" height="50" class="rounded">';
                })
                ->addColumn('products_count', fn($brand) => $brand->products->count())
                ->addColumn('website', function ($brand) {
                    if ($brand->website) {
                        return '<a href="' . $brand->website . '" target="_blank" class="text-decoration-none">' . $brand->website . '</a>';
                    }
                    return '<span class="text-muted">N/A</span>';
                })
                ->addColumn('status', function ($brand) {
                    $badgeClass = $brand->is_active ? 'bg-success' : 'bg-secondary';
                    $status     = $brand->is_active ? 'ACTIVE' : 'INACTIVE';
                    return '<span class="badge ' . $badgeClass . '">' . $status . '</span>';
                })
                ->addColumn('action', function ($brand) {
                    $show   = '<a href="' . route('admin.brands.show', $brand->id) . '" class="btn btn-sm btn-outline-info me-1">View</a>';
                    $edit   = '<a href="' . route('admin.brands.edit', $brand->id) . '" class="btn btn-sm btn-outline-primary me-1">Edit</a>';
                    $delete = '<form method="POST" action="' . route('admin.brands.destroy', $brand->id) . '" style="display:inline-block;">'
                    . csrf_field()
                    . method_field('DELETE')
                        . '<button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>'
                        . '</form>';
                    return $show . ' ' . $edit . ' ' . $delete;
                })
                ->rawColumns(['logo', 'website', 'status', 'action'])
                ->make(true);
        }

        return view('admin.brands.index');
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|unique:brands,name|max:255',
            'description' => 'nullable|string',
            'website'     => 'nullable|url',
            'is_active'   => 'boolean',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $brand = Brand::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'website'     => $request->website,

            'is_active'   => $request->is_active ?? false,
        ]);

        if ($request->hasFile('logo')) {

            $image = $request->file('logo'); // get the file

            $fileName = Str::slug($request->name) . '-' . time() . '.' . $image->getClientOriginalExtension();

            $brand->addMedia($request->file('logo'))
                ->usingFileName($fileName)
                ->toMediaCollection('logos', 'public');
        }

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand created successfully.');
    }

    public function show(Brand $brand)
    {
        return view('admin.brands.show', compact('brand'));
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $validator = Validator::make($request->all(), [
            'name'        => [
                'required',
                'string',
                'max:255',
                Rule::unique('brands', 'name')->ignore($brand->id),
            ],
            'description' => 'nullable|string',
            'website'     => 'nullable|url',
            'is_active'   => 'boolean',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $brand->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'website'     => $request->website,
            'is_active'   => $request->is_active ?? false,
        ]);

        if ($request->hasFile('logo')) {
            $brand->clearMediaCollection('logos');

            $image = $request->file('logo'); // get the file

            $fileName = Str::slug($request->name) . '-' . time() . '.' . $image->getClientOriginalExtension();

            $brand->addMedia($request->file('logo'))
                ->usingFileName($fileName)
                ->toMediaCollection('logos', 'public');
        }

        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand updated successfully.');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.brands.index')
            ->with('success', 'Brand deleted successfully.');
    }
}
