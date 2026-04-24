<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::get('/products', [ProductController::class, 'getList']);

Route::prefix('/orders')->group(function() {
    Route::post('/', [OrderController::class, 'create'])->name('create-order');

    Route::get('/', [OrderController::class, 'getList']);
    Route::get('/{order}', [OrderController::class, 'getDetail']);

    Route::patch('/{order}/status', [OrderController::class, 'updateStatus']);
});
