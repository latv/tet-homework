
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::prefix('api')->group(function () {
    Route::get('products', [ProductController::class, 'index']);
    Route::get('products/{id}', [ProductController::class, 'show']);
    Route::post('products', [ProductController::class, 'store']);
    Route::put('products/{id}', [ProductController::class, 'update']);

    // add rest of routing
});