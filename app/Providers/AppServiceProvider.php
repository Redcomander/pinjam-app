<?php

namespace App\Providers;

use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
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
            $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get();
            $view->with('cartItems', $cartItems);
        });
    }
}
