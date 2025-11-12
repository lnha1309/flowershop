<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\UnifiedLoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

// Products - use ProductController so blade route names use products.index
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');

// Cart routes (use CartController which accepts JSON payloads)
// Note: client-side posts to /cart/add with product_id in JSON body

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Account page for authenticated users
Route::get('/account', [AuthController::class, 'account'])->name('account')->middleware('auth');
// Update account (profile) information
Route::put('/account', [AuthController::class, 'update'])->name('account.update')->middleware('auth');

// Registration routes
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.submit');
Route::post('/register/send-verification-code', [RegisterController::class, 'sendVerificationCode'])->name('register.send-verification-code');
Route::post('/register/verify-code', [RegisterController::class, 'verifyCode'])->name('register.verify-code');

// Sửa lại route details để sử dụng ProductController
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');

// Thêm routes cho wishlist
Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add')->middleware('auth');
Route::delete('/wishlist/remove/{product_id}', [WishlistController::class, 'remove'])->name('wishlist.remove')->middleware('auth');
Route::get('/wishlist/check/{product_id}', [WishlistController::class, 'check'])->name('wishlist.check');

Route::get('/admin', AdminDashboardController::class)->name('admin.dashboard');
// Thêm vào routes/web.php
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/get', [CartController::class, 'getCart'])->name('cart.get');
Route::put('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.remove');
