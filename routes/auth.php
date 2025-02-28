<?php

use App\Http\Middleware\GuestMiddleware;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::post('/logout', function () {
    auth()->logout();
    return redirect(route('home'))->with('success', 'See you later.');
})->name('logout')->middleware('auth');

Route::middleware(GuestMiddleware::class)->group(function () {
    Route::get('/login', function () {
        return Inertia::render('Login');
    })->name('show-login');
    Route::get('/register', function () {
        return Inertia::render('Register');
    })->name('show-register');

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
});
