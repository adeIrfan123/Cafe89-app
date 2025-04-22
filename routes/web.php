<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
// Route::post('/checkout', [CheckoutController::class, 'buyNow'])->name('checkout.buy-now');
// Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
// Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
