<?php

use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderHistoryController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('categories', CategoryController::class)->withoutMiddleware(VerifyCsrfToken::class);

Route::apiResource('menu-items', MenuItemController::class)->withoutMiddleware(VerifyCsrfToken::class);

Route::apiResource('orders', OrderController::class)->withoutMiddleware(VerifyCsrfToken::class);

Route::prefix('history')->group(function () {
    Route::get('/', [OrderHistoryController::class, 'index'])->withoutMiddleware(VerifyCsrfToken::class);
    Route::get('/date-range', [OrderHistoryController::class, 'getByDateRange'])->withoutMiddleware(VerifyCsrfToken::class);
    Route::get('/{order}', [OrderHistoryController::class, 'show'])->withoutMiddleware(VerifyCsrfToken::class);
});