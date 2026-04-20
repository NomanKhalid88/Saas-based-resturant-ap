<?php

use App\Http\Controllers\Apis\AuthController;
use App\Http\Controllers\Apis\OrderController;
use App\Http\Controllers\Apis\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('auth')->group(function () {

    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
    });

});


/*
|--------------------------------------------------------------------------
| PROTECTED SAAS ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    // Products API (tenant scoped via merchant_uuid)
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::post('/orders', [OrderController::class, 'store']);

});