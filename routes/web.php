<?php

use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\FirstLoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect'])->name('login.redirect');
Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback'])->name('login.callback');

Route::resource('profil', UserController::class);

Route::get('/changepassword', [UserController::class, 'changePassword'])->name('changepassword');


require __DIR__ . '/auth.php';
