<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');
Route::get('/products/t-shirt', function () {
    return Inertia::render('ProductDetail');
});

Route::get('/checkout', function () {
    return Inertia::render('Checkout');
});

Route::get('/admin/dashboard', function () {
    return Inertia::render('Admin/Dashboard');
})->name('admin.dashboard');
Route::get('/admin/users', function () {

    return Inertia::render('Admin/User/Index', [
        'users' => User::paginate(10)
    ]);
})->name('admin.users.index');
Route::get('/admin/orders', function () {
    return Inertia::render('Admin/Dashboard');
})->name('admin.orders.index');
Route::get('/admin/subscribers', function () {
    return Inertia::render('Admin/Dashboard');
})->name('admin.subscriber.index');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
