<?php

use App\Http\Controllers\ProfileController;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    $products = Product::with(['images', 'category'])->filter(request()->all())->get();
    return Inertia::render('Home', [
        'products' => $products,
        'filters' => [
            'search' => request('search'),
            'category' => request('category')
        ]
    ]);
})->name('home');
Route::get('/products/{product:slug}', function (Product $product) {
    $product = Product::with(['images', 'category', 'productDetails', 'productDetails.size'])->find($product->id);

    $productWithSize = Product::with(['productDetails' => function ($query) {
        return $query->with('size');
    }])->where('id', $product->id)->first();

    $sizes = $productWithSize->productDetails->map(function ($detail) {
        return $detail->size ? $detail->size->name : null; // Adjust 'name' to your actual size field
    })->filter()->unique();

    $latestProducts = Product::with(['images', 'category'])->latest()->limit(6)->get();

    $relatedProducts = Product::with('images')->where('category_id', $product->category->id)->limit(6)->get();

    return Inertia::render('ProductDetail', [
        'product' => $product,
        'sizes' => $sizes,
        'latestProducts' => $latestProducts,
        'relatedProducts' => $relatedProducts
    ]);
})->name('product-detail');

Route::get('/checkout', function () {
    return Inertia::render('Checkout', [
        'payments' => Payment::all()
    ]);
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
