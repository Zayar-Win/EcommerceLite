<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductDetailController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Models\Order;
use Inertia\Inertia;

Route::prefix('/admin')
    ->name('admin.')
    ->group(function () {

        Route::get('dashboard', function () {
            return Inertia::render('Admin/Dashboard');
        })->name('dashboard');
        Route::get('/orders', function () {
            $orders = Order::with('payment')->latest()->paginate(10);
            return Inertia::render('Admin/Orders/Index', [
                'orders' => $orders
            ]);
        })->name('orders.index');

        Route::get('/orders/{order}', [OrderController::class, 'orderDetail'])->name('orders.orderDetail');

        Route::get('/subscribers', function () {
            return Inertia::render('Admin/Dashboard');
        })->name('subscriber.index');

        // User
        Route::resource('users', UserController::class);

        // Product
        Route::get('/products', [ProductController::class,'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class,'create'])->name('products.create');
        Route::post('/products/store', [ProductController::class,'store'])->name('products.store');
        Route::get('/products/edit/{product}', [ProductController::class,'edit'])->name('products.edit');
        Route::put('/products/edit/{product}', [ProductController::class,'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class,'destroy'])->name('products.destroy');

        // Product Detail
        Route::get('/product/{id}/product-details', [ProductDetailController::class, 'index'])->name('product-details.index');
        Route::get('/product/{id}/product-details/create', [ProductDetailController::class, 'create'])->name('product-details.create');
        Route::post('/product/{id}/product-details', [ProductDetailController::class, 'store'])->name('product-details.store');
        Route::get('/product/{productId}/product-details/{detailId}/edit', [ProductDetailController::class, 'edit'])->name('product-details.edit');
        Route::put('/product/{productId}/product-details/{detailId}', [ProductDetailController::class, 'update'])->name('product-details.update');
        Route::delete('/product/{productId}/product-details/{detailId}', [ProductDetailController::class, 'destroy'])->name('product-details.destroy');

        // Route::resource('product-details', ProductDetailController::class)->except(['index']);


        // Attribute
        Route::resource('/attributes', AttributeController::class);
    });
