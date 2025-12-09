<?php

use Illuminate\Support\Facades\Route;
use Tet\Products\Controllers\ProductController;

// Products CRUD
Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/create', [ProductController::class, 'createView'])->name('products.create.view');
Route::get('products/update/{id}', [ProductController::class, 'editView'])->name('products.edit.view');
Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::post('products', [ProductController::class, 'store'])->name('products.store');
Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::patch('products/{id}', [ProductController::class, 'update']);
Route::delete('products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::post('products/import', [ProductController::class, 'import'])->name('products.import'); // <--- Add this line