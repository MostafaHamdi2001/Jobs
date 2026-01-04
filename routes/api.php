<?php

use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// ===== Login =====
Route::post('/login', [LoginController::class, 'login']);

// ===== Products Group =====
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);       // GET /api/products
    Route::post('/', [ProductController::class, 'store']);      // POST /api/products
    Route::put('/{product}', [ProductController::class, 'update']); // PUT /api/products/{product}
    Route::delete('/{product}', [ProductController::class, 'destroy']); // DELETE /api/products/{product}
});

// ===== Colors Group =====
Route::prefix('colors')->group(function () {
    Route::get('/', [ColorController::class, 'index']);       // GET /api/colors
    Route::post('/', [ColorController::class, 'store']);      // POST /api/colors
    Route::put('/{color}', [ColorController::class, 'update']); // PUT /api/colors/{color}
    Route::delete('/{color}', [ColorController::class, 'destroy']); // DELETE /api/colors/{color}
});