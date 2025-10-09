<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    /**
     * Display the specified category.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\View\View
     */
    public function show(Category $category)
    {
        // // Get products associated with this category
        // $products = $category->products()
        //     ->where('is_active', true)
        //     ->with(['brand', 'media'])
        //     ->paginate(12);

        // return view('categories.show', compact('category', 'products'));

        // Collect parent + children IDs
        $categoryIds   = $category->children()->pluck('id')->toArray();
        $categoryIds[] = $category->id;

        // Fetch products belonging to these categories
        $products = Product::whereHas('categories', function ($query) use ($categoryIds) {
            $query->whereIn('categories.id', $categoryIds);
        })
            ->where('is_active', true)
            ->with(['brand', 'media'])
            ->paginate(12);

        return view('categories.show', compact('category', 'products'));

    }
}
