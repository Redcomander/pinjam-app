<?php

namespace App\Providers;

use App\Models\CartItem;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
    public function boot()
    {
        // Share cart items data with layouts.navbar view
        View::composer('layouts.navbar', function ($view) {
            $cartItems = CartItem::all(); // Adjust based on your application logic
            $view->with('cartItems', $cartItems);
        });
    }
}
