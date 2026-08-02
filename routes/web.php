<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\DaftarController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Master\ProductController;

Route::middleware('guest')->group(function () {

    Route::get('/daftar', [DaftarController::class, 'index'])
        ->name('daftar');

    Route::post('/daftar', [DaftarController::class, 'store'])
        ->name('daftar.store');

});

Route::middleware('guest')->group(function () {

    Route::get('/', [LoginController::class, 'index'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'store'])
        ->name('login.store');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('products', ProductController::class);

    Route::post('/logout', LogoutController::class)
        ->name('logout');

});

