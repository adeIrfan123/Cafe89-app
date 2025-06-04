<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        View::composer('*', function ($view) {
            $cartCount = 0;
            if(Auth::guard('customer')->check()){
                $cart =Auth::guard('customer')->user()->cart;
                if($cart){
                    $cartCount = $cart->items->count();
            }
        }
        $view->with('cartCount', $cartCount);
        });
    }
}
