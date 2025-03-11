<?php

use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderHistoryController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('categories', CategoryController::class);

Route::apiResource('menu-items', MenuItemController::class);

Route::apiResource('orders', OrderController::class);

Route::prefix('history')->group(function () {
    Route::get('/', [OrderHistoryController::class, 'index']);
    Route::get('/date-range', [OrderHistoryController::class, 'getByDateRange']);
    Route::get('/{order}', [OrderHistoryController::class, 'show']);
});