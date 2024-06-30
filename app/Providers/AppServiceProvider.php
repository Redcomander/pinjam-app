<?php

namespace App\Providers;

use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use PharIo\Manifest\Url;

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
        if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&  $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            \URL::forceScheme('https');
        }
        // Share cart items and notifications data with layouts.navbar view
        View::composer('layouts.navbar', function ($view) {
            $user = Auth::user();
            $cartItems = $user ? CartItem::where('user_id', $user->id)->with('product')->get() : collect();
            $notifications = $user ? $user->unreadNotifications : collect();
            $view->with([
                'cartItems' => $cartItems,
                'notifications' => $notifications,
            ]);
        });
    }
}
