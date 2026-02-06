<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\PricesProductController;

Route::resource('products', ProductController::class);
Route::resource('currencies', CurrencyController::class);

Route::post('products/{product}/prices', [ProductController::class, 'addProductPrice']);
Route::get('products/{product}/prices', [ProductController::class, 'getProductPrices']);
