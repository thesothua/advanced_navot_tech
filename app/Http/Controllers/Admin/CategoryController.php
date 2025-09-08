<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::with(['media', 'parent'])->withCount(['products', 'children'])->select('categories.*')->latest();

            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('image', function ($category) {
                    $media = $category->getFirstMedia('images');

                    if (! $media) {
                        // return '<img src="https://via.placeholder.com/50x50?text=No+Image" alt="no image" width="50" height="50" class="rounded">';

                        return '<div class="d-flex justify-content-center align-items-center bg-light text-muted border rounded"
                                        style="width:50px; height:50px;">
                                        <i class="fas fa-box fa-lg"></i>
                                 </div>';
                    }

                    $url = $media->getUrl();
                    return '<img src="' . $url . '" alt="' . e($category->name ?? 'Category') . '" width="50" height="50" class="rounded">';
                })
                ->addColumn('products_count', fn($category) => $category->products->count())
                ->addColumn('status', function ($category) {
                    $badgeClass = $category->is_active ? 'bg-success' : 'bg-secondary';
                    $status     = $category->is_active ? 'ACTIVE' : 'INACTIVE';
                    return '<span class="badge ' . $badgeClass . '">' . $status . '</span>';
                })
                ->addColumn('hierarchy', function ($category) {
                    return $category->full_hierarchy;
                })
                ->addColumn('parent_name', function ($category) {
                    return $category->parent ? $category->parent->name : '-';
                })

                ->addColumn('action', function ($category) {
                    $show   = '<a href="' . route('admin.categories.show', $category->slug) . '" class="btn btn-sm btn-outline-info me-1">View</a>';
                    $edit   = '<a href="' . route('admin.categories.edit', $category->id) . '" class="btn btn-sm btn-outline-primary me-1">Edit</a>';
                    $delete = '<form method="POST" action="' . route('admin.categories.destroy', $category->id) . '" style="display:inline-block;">'
                    . csrf_field()
                    . method_field('DELETE')
                        . '<button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm(\'Are you sure? This will affect all child categories.\')">Delete</button>'
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
        $categories = Category::where('parent_id', null)->with('allChildren')->get();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|unique:categories,name|string|max:255',
            'description' => 'nullable|string',
            'is_active'   => 'boolean',

            'parent_id'   => 'nullable|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        // Prevent circular reference
        if ($request->parent_id) {
            $parent = Category::find($request->parent_id);
            if ($parent && $parent->allParents()->count() > 1) {
                return back()->withErrors(['parent_id' => 'Maximum nesting level (5) exceeded.']);
            }
        }

        $category = Category::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'parent_id'   => $request->parent_id,
            'is_active'   => $request->is_active ?? false,

        ]);

        if ($request->hasFile('image')) {

            $image = $request->file('image'); // get the file

            $fileName = Str::slug($request->name) . '-' . time() . '.' . $image->getClientOriginalExtension();

            $category->addMedia($request->file('image'))
                ->usingFileName($fileName)
                ->toMediaCollection('images', 'public');
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
        $categories = Category::where('id', '!=', $category->id)
            ->where(function ($query) use ($category) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '!=', $category->id);
            })
            ->with('allChildren')
            ->get();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category)
    {

        $validator = Validator::make($request->all(), [
            'name'        => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($category->id),
            ],
            'description' => 'nullable|string',
            'is_active'   => 'boolean',
            'parent_id'   => 'nullable|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Prevent circular reference and self-reference
        if ($request->parent_id) {
            if ($request->parent_id == $category->id) {
                return back()->withErrors(['parent_id' => 'A category cannot be its own parent.']);
            }

            $parent = Category::find($request->parent_id);
            if ($parent && $parent->allParents()->count() > 1) {
                return back()->withErrors(['parent_id' => 'Maximum nesting level (5) exceeded.']);
            }
        }

        $category->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->name),
            'description' => $request->description,
            'is_active'   => $request->is_active ?? false,

        ]);

        if ($request->hasFile('image')) {

            $image = $request->file('image'); // get the file

            $fileName = Str::slug($request->name) . '-' . time() . '.' . $image->getClientOriginalExtension();

            $category->clearMediaCollection('images');
            $category->addMedia($request->file('image'))
                ->usingFileName($fileName)
                ->toMediaCollection('images', 'public');
        }

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        // Update child categories to point to the deleted category's parent
        $parentId = $category->parent_id;
        $category->children()->update(['parent_id' => $parentId]);

        $category->delete();
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
