<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

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
        // Get products associated with this category
        $products = $category->products()
            ->where('is_active', true)
            ->with(['brand', 'media'])
            ->paginate(12);
            
        return view('categories.show', compact('category', 'products'));
    }
}