<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::controller(CategoryController::class)->prefix('categories')->group(function () {
    Route::get('/', 'index')->name('category.index');
    Route::get('/create', 'create')->name('category.create');
    Route::post('/store', 'store')->name('category.post');
    Route::get('/edit/{category}', 'edit')->name('category.edit');
    Route::put('/update/{category}', 'update')->name('category.update');
    Route::delete('/delete/{category}', 'destroy')->name('category.destroy');
});

Route::controller(ProductController::class)->prefix('products')->group(function () {
    Route::get('/', 'index')->name('product.index');
    Route::get('/create', 'create')->name('product.create');
    Route::post('/store', 'store')->name('product.post');
    Route::get('/show/{product}', 'show')->name('product.show');
    Route::get('/edit/{product}', 'edit')->name('product.edit');
    Route::put('/update/{product}', 'update')->name('product.update');
    Route::delete('/delete/{product}', 'destroy')->name('product.destroy');
});


Route::get('/my-ecommerce', function () {
    return view('frontend.index');
});
