<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
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
        Route::post('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');

        Route::get('/subscribers', function () {
            return Inertia::render('Admin/Dashboard');
        })->name('subscriber.index');

        // User
        Route::resource('users', UserController::class);

        // Attribute
        Route::resource('/attributes', AttributeController::class);

        Route::resource('payments', PaymentController::class);

        Route::resource('categories', CategoryController::class);
    });
