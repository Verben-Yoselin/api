<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Rutas protegidas por autenticación
Route::middleware('auth:sanctum')->group(function () {
    // Rutas de Usuario
    Route::apiResource('users', UserController::class);

    // Rutas de Productos
    Route::apiResource('products', ProductController::class);

    // Rutas de Órdenes
    Route::apiResource('orders', OrderController::class);

    // Rutas de Detalles de Orden (con rutas personalizadas por llave compuesta)
    Route::get('order-details', [OrderDetailController::class, 'index']);
    Route::post('order-details', [OrderDetailController::class, 'store']);
    Route::get('order-details/{order_id}/{product_id}', [OrderDetailController::class, 'show']);
    Route::put('order-details/{order_id}/{product_id}', [OrderDetailController::class, 'update']);
    Route::delete('order-details/{order_id}/{product_id}', [OrderDetailController::class, 'destroy']);

    // Rutas de Clientes
    Route::apiResource('clients', ClientController::class);

    // Rutas de Categorías de Productos
    Route::apiResource('category-products', CategoryProductController::class);
});

// Rutas públicas de autenticación
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register_person']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
