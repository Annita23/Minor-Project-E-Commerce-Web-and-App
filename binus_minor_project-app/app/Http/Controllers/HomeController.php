<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all(); // get all products from the database
        return view('welcome', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id); 
        
        return view('product-detail', compact('product'));
    }
}