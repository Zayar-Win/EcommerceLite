<?php
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



    });