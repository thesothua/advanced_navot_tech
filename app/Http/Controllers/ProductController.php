<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::where('is_active', true)
            ->with(['brand', 'media'])
            ->paginate(12);
            
        return view('products', compact('products'));
    }

    /**
     * Display the specified product details.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product)
    {
        // Ensure the product is active
        if (!$product->is_active) {
            abort(404);
        }

        // Load relationships
        $product->load(['brand', 'categories', 'media']);
        
        // Get all images for the carousel
        $images = $product->getMedia('images');
        
        // Get related products from the same categories
        $relatedProducts = Product::where('is_active', true)
            ->where('id', '!=', $product->id)
            ->whereHas('categories', function ($query) use ($product) {
                $query->whereIn('categories.id', $product->categories->pluck('id'));
            })
            ->with(['brand', 'media'])
            ->limit(4)
            ->get();

        return view('product-details', compact('product', 'images', 'relatedProducts'));
    }
}