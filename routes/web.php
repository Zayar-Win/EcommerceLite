<?php

use App\Http\Controllers\OrderController;
use App\Http\Middleware\CelebrateMiddleware;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Subscriber;
use App\Models\Ticket;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    $products = Product::with(['images', 'category', 'productDetails'])->filter(request()->all())->whereHas('productDetails')->orderByRaw('CASE WHEN priority IS NULL THEN 9 ELSE priority END')->paginate(20);
    $categories = Category::all();

    if (request()->expectsJson()) {
        return response()->json([
            'productsData' => $products,
        ]);
    }
    return Inertia::render('Home', [
        'productsData' => $products,
        'categories' => $categories,
        'filters' => [
            'search' => request('search'),
            'category' => request('category')
        ]
    ]);
})->name('home');

Route::post('/subscribers', function () {
    $validatedData  = request()->validate([
        'email' => ['required', 'email']
    ]);

    $isAlreadySubscribe = Subscriber::where('email', $validatedData['email'])->exists();

    if ($isAlreadySubscribe) {
        return back()->with('warning', 'Your email is already subscribed.');
    } else {
        Subscriber::create([
            'email' => $validatedData['email']
        ]);
        return back()->with('success', 'Subscribed successful.');
    }
})->name('subscribe');

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
        $productDetail = $product->productDetails()->with('attributeOptions', 'attributeOptions.attribute')->where(function ($query) use ($filters) {
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

    $latestProducts = Product::with(['images', 'category', 'productDetails'])->whereHas('productDetails')->latest()->limit(6)->get();

    $relatedProducts = Product::with('images', 'productDetails')->where('category_id', $product->category->id)->whereHas('productDetails')->limit(6)->get();
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
Route::get('/support-ticket', function () {
    return Inertia::render('SupportTicket');
});
Route::post('/support-ticket', function () {
    $validatedData = request()->validate([
        'name'  => ['required', 'min:3'],
        'email'  => ['required', 'email'],
        'phone' => ['required', 'min:6'],
        'description' =>  ['required', 'min:10']
    ]);

    Ticket::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'status' => 'pending',
        'phone' => $validatedData['phone'],
        'message' => $validatedData['description']
    ]);

    return redirect(route('home'))->with('success', 'Ticket create successful.');
})->name('ticket.store');

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/private.php';
