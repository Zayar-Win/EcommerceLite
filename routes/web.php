<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CelebrateMiddleware;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
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

Route::get('/login', function () {
    return Inertia::render('Login');
})->name('show-login');
Route::get('/register', function () {
    return Inertia::render('Register');
})->name('show-register');


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

Route::post('/register', function () {
    $validatedData = request()->validate([
        'name' => ['required', 'min:2'],
        'email' => ['required', 'email'],
        'phone' => ['required', 'min:6'],
        'password' => ['required', 'min:6']
    ]);

    $user = User::where('email', $validatedData['email'])->first();
    if ($user) {
        return back()->withErrors([
            'email' => 'Email is already used.'
        ]);
    }

    $hashPassword = Hash::make($validatedData['password']);
    $validatedData['password'] = $hashPassword;
    $user = User::create($validatedData);
    auth()->login($user);
    return redirect(route('home'))->with('success', 'Register successful.');
})->name('register');


Route::middleware('auth')->group(function () {

    Route::get('/settings/profile-detail', function () {
        return Inertia::render('Private/Settings/ProfileDetails');
    })->name('settings.profile-details');
    Route::get('/settings/change-password', function () {
        return Inertia::render('Private/Settings/ChangePassword');
    })->name('settings.change-password');

    Route::patch('{user}/profile-update', function (User $user) {
        $validatedData = request()->validate([
            'name' => ['required', 'min:2'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'min:6'],
            'telegram' => ['nullable'],
            'viber' => ['nullable'],
            'fb_profile_link' => ['nullable'],
            'address' => ['required', 'min:4']
        ]);

        $user->update($validatedData);
        return back()->with('success', 'Profile Detail Update success.');
    })->name('settings.profile.update');

    Route::put('{user}/password-update', function (User $user) {
        $validatedData = request()->validate([
            'current_password' => ['required', 'min:6'],
            'new_password' => ['required', 'min:6'],
        ]);

        $isPasswordCorrect = Hash::check($validatedData['current_password'], $user->password);

        if (!$isPasswordCorrect) {
            return back()->withErrors([
                'current_password' => 'Your password is not correct'
            ]);
        }
        $hashPassword = Hash::make($validatedData['new_password']);

        $user->update([
            'password' => $hashPassword
        ]);
        return back()->with('success', 'Passowrd update successful.');
    })->name('password.update');

    Route::get('/settings/orders', function () {
        $orders = Order::with('payment')->where('user_id', auth()->user()->id)->paginate(10);
        return Inertia::render('Private/Settings/Orders', [
            'orders' => $orders
        ]);
    })->name('settings.orders');

    Route::get('/settings/orders/{order}/detail', function (Order $order) {
        $order = Order::where('id', $order->id)->with(['user', 'orderProductDetails', 'orderProductDetails.productDetail', 'orderProductDetails.productDetail.product.images', 'orderProductDetails.productDetail.attributeOptions', 'orderProductDetails.productDetail.attributeOptions.attribute'])->first();
        return Inertia::render('Private/Settings/OrderDetail', [
            'order' => $order
        ]);
    })->name('orders.detail');
});

Route::post('/logout', function () {
    auth()->logout();
    return redirect(route('home'))->with('success', 'See you later.');
})->name('logout');

Route::post('/login', function () {
    $validatedData = request()->validate([
        'email' => ['required', 'email'],
        'password' => ['required', 'min:6']
    ]);

    $user = User::where('email', $validatedData['email'])->first();
    if (!$user) {
        return back()->withErrors([
            'email' => 'Email doesn\'t exists.'
        ]);
    }

    $isPasswordCorrect = Hash::check($validatedData['password'], $user->password);
    if ($isPasswordCorrect) {
        auth()->login($user);
        return redirect(route('home'))->with(
            'success',
            'Login success.'
        );
    } else {
        return back()->withErrors([
            'password' => 'Your password is wrong.'
        ]);
    }
})->name('login');

// require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
