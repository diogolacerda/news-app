<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/home/{news}', [HomeController::class, 'show'])->name('home.show');

Route::resource('categories', CategoryController::class, ['except' => ['show']]);
Route::resource('news', NewsController::class, ['except' => ['show']]);

require __DIR__.'/auth.php';
