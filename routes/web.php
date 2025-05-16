<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('guest');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add')->middleware('auth:customer');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth:customer');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
// Route::prefix('customer')->group(function () {
Route::get('/register', [CustomerController::class, 'showRegisterForm'])->middleware('guest:customer');
Route::post('/register', [CustomerController::class, 'register']);
Route::get('/login', [CustomerController::class, 'showLoginForm'])->name('login');
Route::post('/login', [CustomerController::class, 'authenticate']);
Route::post('/logout', [CustomerController::class, 'logout'])->name('customer.logout');
// });
// Route::post('/checkout', [CheckoutController::class, 'buyNow'])->name('checkout.buy-now');
// Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
// Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
