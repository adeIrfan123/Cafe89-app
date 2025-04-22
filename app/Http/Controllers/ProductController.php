<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index()
    {
        $categories = Category::with('products')->get();
        $products = Product::get();
        return view('product', compact('products', 'categories'));
    }

    public function show()
    {
        $product = Product::where('slug', request('slug'))->firstOrFail();
        return view('product_detail', compact('product'));
    }
}
