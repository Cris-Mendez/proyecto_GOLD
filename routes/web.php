<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureTokenIsValid;

// Rutas para autenticación
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Ruta para productos, protegida por el middleware EnsureTokenIsValid
Route::middleware(['auth'])->group(function () {
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});
