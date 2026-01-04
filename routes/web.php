<?php

use App\Http\Controllers\Api\Login;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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
// ===== Login =====
Route::post('/login', [LoginController::class, 'login']);

// ===== Products Group =====
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/', [ProductController::class, 'store'])->name('products.store');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

// ===== Colors Group =====
Route::prefix('colors')->group(function () {
    Route::get('/', [ColorController::class, 'index'])->name('colors.index');
    Route::get('/create', [ColorController::class, 'create'])->name('colors.create');
    Route::post('/', [ColorController::class, 'store'])->name('colors.store');
    Route::get('/{color}/edit', [ColorController::class, 'edit'])->name('colors.edit');
    Route::put('/{color}', [ColorController::class, 'update'])->name('colors.update');
    Route::delete('/{color}', [ColorController::class, 'destroy'])->name('colors.destroy');
});