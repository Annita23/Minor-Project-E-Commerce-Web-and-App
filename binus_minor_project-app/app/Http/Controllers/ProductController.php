<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // display product details
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('product-detail', compact('product'));
    }

    // for android app
    public function apiIndex()
    {
        // Get all products and return as JSON
        return response()->json(\App\Models\Product::all());
    }
}