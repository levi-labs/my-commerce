<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
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
