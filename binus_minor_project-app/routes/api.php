<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

//  http://127.0.0.1:8000/api/products

Route::get('/products', function () {
    $products = Product::all();
    
    return response()->json($products);
});

Route::get('/products', [ProductController::class, 'apiIndex']);