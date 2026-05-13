<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

// route untuk test flash message
Route::get('/dashboard', function () {
    return redirect('/')->with('success', 'Top up berhasil!');
});

Route::resource('products', ProductController::class);
