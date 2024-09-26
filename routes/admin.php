<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\TicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Models\Order;
use App\Models\Product;
use App\Models\Ticket;
use App\Models\User;
use Inertia\Inertia;

Route::prefix('/admin')
    ->name('admin.')
    ->group(function () {

        Route::get('dashboard', function () {
            $latestProducts = Product::with('images', 'category')->latest()->paginate(2);
            $latestUsers = User::latest()->paginate(2);
            $latestOrders = Order::with('user', 'payment')->latest()->paginate(2);
            $latestTickets = Ticket::paginate(2);
            return Inertia::render('Admin/Dashboard', [
                'latestProducts' => $latestProducts,
                'latestUsers' => $latestUsers,
                'latestOrders' => $latestOrders,
                'latestTickets' => $latestTickets,
                'orderCount' => Order::count(),
                'userCount' => User::count(),
                'ticketCount' => Ticket::count(),
                'totalAmount' => Order::sum('total_amount')
            ]);
        })->name('dashboard');
        Route::get('/orders', function () {
            $orders = Order::with('payment')->filterBy(request()->all())->latest()->paginate(10);
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

        Route::resource('tickets', TicketController::class);
        Route::resource('subscribers', SubscriberController::class);
    });
