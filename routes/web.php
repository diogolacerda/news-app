<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});

Route::resource('categories', CategoryController::class, ['except' => ['show']]);

require __DIR__.'/auth.php';
