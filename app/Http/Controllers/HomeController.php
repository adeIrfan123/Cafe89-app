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
        $title = 'Home';

        return view('home', compact('categories', 'products', 'banners', 'title'));
    }

    public function contact()
    {
        $title = 'Contact';
        return view('contact', compact('title'));
    }
    public function about()
    {
        $title = 'About';
        return view('about', compact('title'));
    }
}
