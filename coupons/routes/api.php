<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CouponController;

Route::prefix('/')->group(function () {
    // List all coupons
    Route::get('coupons', [CouponController::class, 'index']);

    // Create a new coupon
    Route::post('coupons', [CouponController::class, 'store']);

    // Show a specific coupon
    Route::get('coupons/{id}', [CouponController::class, 'show']);

    // Update a coupon
    Route::put('coupons/{id}', [CouponController::class, 'update']);
    Route::patch('coupons/{id}', [CouponController::class, 'update']);

    // Delete a coupon
    Route::delete('coupons/{id}', [CouponController::class, 'destroy']);
});