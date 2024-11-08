<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});

Route::resource('categories', CategoryController::class, ['except' => ['show']]);
Route::resource('news', NewsController::class, ['except' => ['show']]);

require __DIR__.'/auth.php';
