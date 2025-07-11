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
        $allProducts = Product::latest()->get();
        $categories = Category::with('products')->get();
        $searchQuery = request('search');

        $searchedProducts = collect();
        if ($searchQuery) {
            $searchedProducts = Product::where('name', 'like', '%' . $searchQuery . '%')->get();
        }

        $title = 'Menu';
        return view('product', compact('allProducts', 'categories', 'searchedProducts', 'title', 'searchQuery'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $title = $slug;
        return view('product_detail', compact('product', 'title'));
    }
}
