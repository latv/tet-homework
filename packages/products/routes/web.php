<?php

use Illuminate\Support\Facades\Route;
use Tet\Products\Controllers\ProductController;

Route::get('products', [ProductController::class, 'index'])->name('products.index');