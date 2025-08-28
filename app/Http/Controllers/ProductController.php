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
}