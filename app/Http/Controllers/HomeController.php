<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Baner;

class HomeController extends Controller
{
    //
    public function index()
    {
        $categories = Category::get();
        $products = Product::get();
        $banners = Baner::get();

        return view('home', compact('categories', 'products', 'banners'));
    }

    public function contact()
    {
        return view('contact');
    }
    public function about()
    {
        return view('about');
    }
}
