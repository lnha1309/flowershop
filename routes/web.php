<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/products', function () {
    return view('products');
})->name('products');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/details', function () {
    return view('details');
})->name('details');

Route::get('/admin', AdminDashboardController::class)->name('admin.dashboard');
