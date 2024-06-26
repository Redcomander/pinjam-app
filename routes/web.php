<?php

use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FirstLoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Livewire\ChatComponent;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Telescope\Http\Middleware\Authorize as MiddlewareAuthorize;
use Laravel\Telescope\Telescope;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Dashboard route
Route::get('/dashboard', [ProductController::class, 'dashboard'])->middleware(['auth', 'verified', 'seller'])->name('dashboard');


// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Social login routes
Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect'])->name('login.redirect');
Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback'])->name('login.callback');

// User profile routes
Route::resource('profil', UserController::class);
Route::get('/changepassword', [UserController::class, 'changePassword'])->name('changepassword');

// Shop routes
Route::middleware(['auth'])->group(function () {
    Route::resource('shop', ShopController::class);
    Route::patch('/become-seller', [UserController::class, 'becomeSeller'])->name('become-seller');
});

// Product Controller
Route::resource('product', ProductController::class);
Route::get('/', [ProductController::class, 'welcome'])->name('welcome');

// Route for the cart page
Route::get('/cart', [ProductController::class, 'cart'])->name('cart');

// Route to add items to the cart
Route::post('/cart/add/{id}', [ProductController::class, 'addToCart'])->middleware(['auth'])->name('cart.add');

// Route to clear the cart
Route::post('/cart/clear', [ProductController::class, 'clearCart'])->name('cart.clear');

// Remove item from the cart
Route::delete('/cart/{id}', [ProductController::class, 'removeFromCart'])->name('cart.remove');

// Category Show Product
Route::get('/category/{category}', [ProductController::class, 'showCategoryProducts'])->name('product.category');

// Search Product
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

// Checkout Product
Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout');
Route::post('/midtrans/callback', [ProductController::class, 'callback']);
Route::get('/checkout-complete/{orderId}', [ProductController::class, 'checkoutComplete'])->name('checkout_complete');

// Order Controller
Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
Route::get('/orders/customer', [OrderController::class, 'customer'])->name('order.customer');
Route::get('/orders/customer/{id}', [OrderController::class, 'show'])->name('order.show');
Route::get('/orders/{id}', [OrderController::class, 'showForOwner'])->name('order.show-owner');
Route::post('/order/confirm/{id}', [OrderController::class, 'confirm'])->name('order.confirm');
Route::post('/order/complete/{id}', [OrderController::class, 'complete'])->name('order.complete');

// Chat Route
Route::get('/chat', [ChatController::class, 'index'])->middleware('auth')->name('chat.index');
Route::get('/chat/with-owner/{order}', [ChatController::class, 'chatWithOwner'])->name('chat.withOwner')->middleware('auth');
Route::post('/chat/send', [ChatController::class, 'sendMessage'])->middleware('auth')->name('chat.sendMessage');
Route::get('/chat/load-messages', [ChatController::class, 'loadMessages'])->middleware('auth')->name('chat.loadMessages');

Route::middleware('auth')->group(function () {
    Route::post('/notifications/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
});

require __DIR__ . '/auth.php';
