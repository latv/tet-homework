<?php

use Illuminate\Support\Facades\Route;
use Tet\Coupons\Controllers\CouponController;

Route::prefix('api/coupons')->group(function () {
    // List all coupons
    Route::get('/', [CouponController::class, 'index']);

    // Create a new coupon
    Route::post('/', [CouponController::class, 'store']);

    // Show a specific coupon
    Route::get('/{id}', [CouponController::class, 'show']);

    // Update a coupon
    Route::put('/{id}', [CouponController::class, 'update']);
    Route::patch('/{id}', [CouponController::class, 'update']);

    // Delete a coupon
    Route::delete('/{id}', [CouponController::class, 'destroy']);
});