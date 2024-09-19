<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CelebrateMiddleware;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    $products = Product::with(['images', 'category'])->filter(request()->all())->paginate(20);


    if (request()->expectsJson()) {
        return response()->json([
            'productsData' => $products,
        ]);
    }
    return Inertia::render('Home', [
        'productsData' => $products,
        'filters' => [
            'search' => request('search'),
            'category' => request('category')
        ]
    ]);
})->name('home');

Route::get('/products/{product:slug}', function (Product $product) {
    $product = Product::with(['images', 'category', 'productDetails', 'productDetails.attributeOptions.attribute', 'productDetails.size'])->find($product->id);

    $filters = request()->query();
    $productDetail = null;
    if (!count($filters)) {
        $productDetail = $product->productDetails()->first();

        $defaultAttribute = $productDetail->attributeOptions->groupBy('attribute.name')->map(function ($options) {
            return $options->first()->value;
        });

        $filters = $defaultAttribute;
    } else {
        $productDetail = $product->productDetails()->where(function ($query) use ($filters) {
            foreach ($filters as $key => $value) {
                $query->whereHas('attributeOptions', function ($query) use ($filters, $key, $value) {
                    $query->whereHas('attribute', function ($query) use ($filters, $key, $value) {
                        return $query->where('name', $key)
                            ->where('value', $value)
                        ;
                    });
                });
            }
        })->first();
    }


    $productWithSize = Product::with(['productDetails' => function ($query) {
        return $query->with('size');
    }])->where('id', $product->id)->first();
    $groupedAttributeOptions = $product->productDetails->flatMap(function ($detail) {
        return $detail->attributeOptions;
    })->groupBy('attribute.name')->map(function ($group) {
        return $group->unique('value');
    });
    $product->groupAttributeOptions = $groupedAttributeOptions;

    $sizes = $productWithSize->productDetails->map(function ($detail) {
        return $detail->size ? $detail->size->name : null; // Adjust 'name' to your actual size field
    })->filter()->unique();

    $latestProducts = Product::with(['images', 'category'])->latest()->limit(6)->get();

    $relatedProducts = Product::with('images')->where('category_id', $product->category->id)->limit(6)->get();
    return Inertia::render('ProductDetail', [
        'product' => $product,
        'filters' => $filters,
        'productDetail' => $productDetail,
        'sizes' => $sizes,
        'latestProducts' => $latestProducts,
        'relatedProducts' => $relatedProducts
    ]);
})->name('product-detail');

Route::get('/checkout', function () {
    return Inertia::render('Checkout', [
        'payments' => Payment::all()
    ]);
})->name('checkout');

Route::get('/celebrate', function () {
    return Inertia::render('Celebrate');
})->name('celebrate')->middleware(CelebrateMiddleware::class);

Route::post('/orders', [OrderController::class, 'store'])->name('order.create');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
