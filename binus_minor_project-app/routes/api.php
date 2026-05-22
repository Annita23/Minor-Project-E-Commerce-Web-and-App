<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

//  http://127.0.0.1:8000/api/products
Route::get('/products', function () {
    $products = Product::all();
    
    return response()->json($products);
});