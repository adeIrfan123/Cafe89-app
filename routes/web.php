<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ShippingController;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('guest');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

Route::middleware(['auth:customer'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/item/{item}', [CartController::class, 'update'])->name('cart.item.update');
    Route::delete('/cart/item/{item}', [CartController::class, 'destroy'])->name('cart.item.destroy');
    Route::post('/shipping', [ShippingController::class, 'searchDestination']);

    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::post('buy-now', [CheckoutController::class, 'buyNow'])->name('buy.now');

    Route::post('cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/api/cek-ongkir', [CheckoutController::class, 'cekOngkir']);
});


Route::get('/register', [CustomerController::class, 'showRegisterForm'])->middleware('guest:customer');
Route::post('/register', [CustomerController::class, 'register']);
Route::get('/login', [CustomerController::class, 'showLoginForm'])->name('login');
Route::post('/login', [CustomerController::class, 'login']);
Route::post('/logout', [CustomerController::class, 'logout'])->name('customer.logout');
