<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; 

// Route::get('/', function () { return "HOME PAGE"; });

// use App\Http\Controllers\BookController;
// Route::get('/books', [BookController::class, 'index']);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/product/{id}', [HomeController::class, 'show'])->name('product.show');