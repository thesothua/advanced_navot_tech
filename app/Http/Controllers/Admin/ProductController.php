<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $products = Product::with(['brand', 'categories', 'media'])->select('products.*');

    //         return DataTables::of($products)
    //             ->addIndexColumn()
    //             ->addColumn('image', function ($product) {
    //                 $url = $product->image_url;

    //                 // dd($url);
    //                 return '<img src="' . $url . '" alt="' . e($product->name ?? 'Product') . '" width="50" height="50" class="rounded" onerror="this.src=\'https://via.placeholder.com/50x50?text=Error\'">';
    //             })
    //             ->editColumn('price', fn ($product) => '₹ ' . number_format($product->price, 2))
    //             ->addColumn('brand', fn ($product) => $product->brand?->name ?? '-')
    //             ->addColumn('categories', function ($product) {
    //                 return $product->categories->pluck('name')->implode(', ') ?: '-';
    //             })
    //             ->addColumn('status', function ($product) {
    //                 $badgeClass = $product->is_active ? 'bg-success' : 'bg-secondary';
    //                 $status = $product->is_active ? 'ACTIVE' : 'INACTIVE';
    //                 return '<span class="badge ' . $badgeClass . '">' . $status . '</span>';
    //             })
    //             ->addColumn('action', function ($product) {
    //                 $show = '<a href="' . route('admin.products.show', $product->slug) . '" class="btn btn-sm btn-outline-info me-1">View</a>';
    //                 $edit = '<a href="' . route('admin.products.edit', $product->slug) . '" class="btn btn-sm btn-outline-primary me-1">Edit</a>';
    //                 $delete = '<form method="POST" action="' . route('admin.products.destroy', $product->slug) . '" style="display:inline-block;">'
    //                     . csrf_field()
    //                     . method_field('DELETE')
    //                     . '<button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>'
    //                     . '</form>';
    //                 return $show . ' ' . $edit . ' ' . $delete;
    //             })
    //             ->rawColumns(['image', 'status', 'action'])
    //             ->make(true);
    //     }

    //     return view('admin.products.index');
    // }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::with(['brand', 'categories', 'media'])->select('products.*');

            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('image', function ($product) {

                    $media = $product->getFirstMedia('images');

                    if (! $media) {
                        // Placeholder with first letter of product name
                        $firstLetter = strtoupper(substr($product->name ?? 'P', 0, 1));
                        // return '<img src="https://via.placeholder.com/50x50?text=' . $firstLetter . '"
                        //             alt="image" width="50" height="50" class="rounded">';

                        return '<div class="d-flex justify-content-center align-items-center bg-light text-muted border rounded"
                                    style="width:50px; height:50px;">
                                    <i class="fas fa-box fa-lg"></i>
                                </div>';
                    }

                    $url = $media->getFullUrl();

                    return '<img src="' . e($url) . '"
                                alt="' . e($product->name ?? 'Product') . '"
                                width="50" height="50" class="rounded">';
                })
                ->editColumn('price', fn($product) => '₹ ' . number_format($product->price, 2))
                ->addColumn('brand', fn($product) => $product->brand?->name ?? '-')
                ->addColumn('categories', function ($product) {
                    return $product->categories->pluck('name')->implode(', ') ?: '-';
                })
                ->addColumn('status', function ($product) {
                    $badgeClass = $product->is_active ? 'bg-success' : 'bg-secondary';
                    $status     = $product->is_active ? 'ACTIVE' : 'INACTIVE';
                    return '<span class="badge ' . $badgeClass . '">' . $status . '</span>';
                })
                ->editColumn('created_at', function ($product) {
                    return $product->created_at ? $product->created_at->format('M d, Y') : '-';
                })
                ->addColumn('action', function ($product) {
                    $show   = '<a href="' . route('admin.products.show', $product->slug) . '" class="btn btn-sm btn-outline-info me-1">View</a>';
                    $edit   = '<a href="' . route('admin.products.edit', $product->slug) . '" class="btn btn-sm btn-outline-primary me-1">Edit</a>';
                    $delete = '<form method="POST" action="' . route('admin.products.destroy', $product->slug) . '" style="display:inline-block;">'
                    . csrf_field()
                    . method_field('DELETE')
                        . '<button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>'
                        . '</form>';
                    return $show . $edit . $delete;
                })
                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        }

        return view('admin.products.index');
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        $brands     = Brand::where('is_active', true)->get();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|unique:products,name|string|max:255',
            'description'    => 'nullable|string',
            'price'          => 'nullable|numeric|min:0',
            'sale_price'     => 'nullable|numeric|min:0',
            'stock'          => 'nullable|integer|min:0',
            'sku'            => 'nullable|string|unique:products,sku',
            'brand_id'       => 'nullable|exists:brands,id',
            'category_ids'   => 'array',
            'category_ids.*' => 'exists:categories,id',
            'is_active'      => 'boolean',
            'is_featured'    => 'boolean',
            'images.*'       => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // dd($request->all());

        $product = Product::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'price'       => $request->price ?? 0,
            'sale_price'  => $request->sale_price ?? 0,
            'stock'       => $request->stock ?? 0,
            'sku'         => $request->sku ?? null,
            'brand_id'    => $request->brand_id ?? null,
            'is_active'   => $request->boolean('is_active', true),
            'is_featured' => $request->boolean('is_featured', false),
        ]);

        if ($request->has('category_ids')) {
            $product->categories()->attach($request->category_ids);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

                $fileName = Str::slug($request->name) . '-' . time() . '.' . $image->getClientOriginalExtension();

                $product->addMedia($image)
                    ->usingFileName($fileName)
                    ->toMediaCollection('images', 'public');
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->get();
        $brands     = Brand::where('is_active', true)->get();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'           => 'required|string|max:255|unique:products,name,' . $product->id,
            'description'    => 'nullable|string',
            'price'          => 'required|numeric|min:0',
            'sale_price'     => 'nullable|numeric|min:0',
            'stock'          => 'required|integer|min:0',
            'sku'            => 'nullable|string|unique:products,sku,' . $product->id,
            'brand_id'       => 'nullable|exists:brands,id',
            'category_ids'   => 'array',
            'category_ids.*' => 'exists:categories,id',
            'is_active'      => 'boolean',
            'is_featured'    => 'boolean',
            'images.*'       => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'price'       => $request->price,
            'sale_price'  => $request->sale_price,
            'stock'       => $request->stock,
            'sku'         => $request->sku,
            'brand_id'    => $request->brand_id ?? null,
            'is_active'   => $request->boolean('is_active', true),
            'is_featured' => $request->boolean('is_featured', false),
        ]);

        if ($request->has('category_ids')) {
            $product->categories()->sync($request->category_ids);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

                $fileName = Str::slug($request->name) . '-' . time() . '.' . $image->getClientOriginalExtension();

                $product->addMedia($image)
                    ->usingFileName($fileName)
                    ->toMediaCollection('images', 'public');
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    public function uploadImages(Request $request, Product $product)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        foreach ($request->file('images') as $image) {
            $product->addMedia($image)->toMediaCollection('images', 'public');
        }

        return back()->with('success', 'Images uploaded successfully.');
    }

    public function deleteImage($mediaId)
    {
        try {
            $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::findOrFail($mediaId);
            $media->delete();

            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting image: ' . $e->getMessage(),
            ], 500);
        }
    }
}
