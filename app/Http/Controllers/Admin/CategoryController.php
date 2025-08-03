<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::with(['media'])->withCount('products')->select('categories.*');
    
            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('image', function ($category) {
                    $media = $category->getFirstMedia('images');
                    
                    if (!$media) {
                        return '<img src="https://via.placeholder.com/50x50?text=No+Image" alt="no image" width="50" height="50" class="rounded">';
                    }
                    
                    $url = $media->getUrl();
                    return '<img src="' . $url . '" alt="' . e($category->name ?? 'Category') . '" width="50" height="50" class="rounded">';
                })
                ->addColumn('products_count', fn ($category) => $category->products_count)
                ->addColumn('sort_order', fn ($category) => $category->sort_order)
                ->addColumn('status', function ($category) {
                    $badgeClass = $category->is_active ? 'bg-success' : 'bg-secondary';
                    $status = $category->is_active ? 'ACTIVE' : 'INACTIVE';
                    return '<span class="badge ' . $badgeClass . '">' . $status . '</span>';
                })
                ->addColumn('action', function ($category) {
                    $show = '<a href="' . route('admin.categories.show', $category->slug) . '" class="btn btn-sm btn-outline-info me-1">View</a>';
                    $edit = '<a href="' . route('admin.categories.edit', $category->slug) . '" class="btn btn-sm btn-outline-primary me-1">Edit</a>';
                    $delete = '<form method="POST" action="' . route('admin.categories.destroy', $category->slug) . '" style="display:inline-block;">'
                        . csrf_field()
                        . method_field('DELETE')
                        . '<button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>'
                        . '</form>';
                    return $show . ' ' . $edit . ' ' . $delete;
                })
                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        }
    
        return view('admin.categories.index');
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        if ($request->hasFile('image')) {
            $category->addMedia($request->file('image'))->toMediaCollection('images', 'public');
        }

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        if ($request->hasFile('image')) {
            $category->clearMediaCollection('images');
            $category->addMedia($request->file('image'))->toMediaCollection('images', 'public');
        }

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
} 