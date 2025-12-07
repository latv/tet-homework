<?php

use Illuminate\Support\Facades\Route;
use Tet\Products\Controllers\ProductController;

// Products CRUD
Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::post('products', [ProductController::class, 'store'])->name('products.store');
Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::patch('products/{id}', [ProductController::class, 'update']);
Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');