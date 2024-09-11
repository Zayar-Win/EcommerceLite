<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use Inertia\Inertia;

Route::prefix('/admin')
    ->name('admin.')
    ->group(function() {

        Route::get('dashboard', function () {
            return Inertia::render('Admin/Dashboard');
        })->name('dashboard');
        Route::get('/orders', function () {
            return Inertia::render('Admin/Dashboard');
        })->name('orders.index');
        Route::get('/subscribers', function () {
            return Inertia::render('Admin/Dashboard');
        })->name('subscriber.index');

        // User
        Route::resource('users', UserController::class);

        // Product
        Route::get('/products', [ProductController::class,'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class,'create'])->name('products.create');
        Route::get('/products/edit', [ProductController::class,'edit'])->name('products.edit');
        Route::get('/products/destroy', [ProductController::class,'destroy'])->name('products.destroy');


    });