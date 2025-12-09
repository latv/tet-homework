<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CouponController;

Route::prefix('/')->group(function () {
    Route::get('coupons', [CouponController::class, 'index']);
    Route::post('coupons', [CouponController::class, 'store']);
    Route::get('coupons/{id}', [CouponController::class, 'show']);
    Route::put('coupons/{id}', [CouponController::class, 'update']);
    Route::patch('coupons/{id}', [CouponController::class, 'update']);
    Route::delete('coupons/{id}', [CouponController::class, 'destroy']);
});