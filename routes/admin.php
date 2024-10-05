<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductDetailController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\TicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Order;
use App\Models\Product;
use App\Models\Ticket;
use App\Models\User;
use Inertia\Inertia;

Route::prefix('/admin')
    ->middleware(['auth', AdminMiddleware::class])
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
            $orders = Order::with('payment')->filterBy(request(['search']))->latest()->orderBy(request('sort', 'id'), request('direction', 'desc'))->paginate(10);
            // $query = User::filterBy(request(['search', 'nationality', 'dob']))->orderBy(request('sort', 'id'), request('direction', 'desc'));
        // $users = $query->paginate(request('per_page', 10))
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

        // Product
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::get('/products/sort', [ProductController::class, 'sort'])->name('products.sort');
        Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/edit/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

        // Product Detail
        Route::get('/product/{product}/product-details', [ProductDetailController::class, 'index'])->name('product-details.index');
        Route::get('/product/{product}/product-details/create', [ProductDetailController::class, 'create'])->name('product-details.create');
        Route::post('/product/{product}/product-details', [ProductDetailController::class, 'store'])->name('product-details.store');
        Route::get('/product/{productId}/product-details/{detailId}/edit', [ProductDetailController::class, 'edit'])->name('product-details.edit');
        Route::put('/product/{productId}/product-details/{detailId}', [ProductDetailController::class, 'update'])->name('product-details.update');
        Route::delete('/product/{productId}/product-details/{detailId}', [ProductDetailController::class, 'destroy'])->name('product-details.destroy');

        // Route::resource('product-details', ProductDetailController::class)->except(['index']);


        // Attribute
        Route::resource('/attributes', AttributeController::class);

        Route::resource('payments', PaymentController::class);

        Route::resource('categories', CategoryController::class);

        Route::resource('tickets', TicketController::class);
        Route::resource('subscribers', SubscriberController::class);
    });
