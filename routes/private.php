<?php

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

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
