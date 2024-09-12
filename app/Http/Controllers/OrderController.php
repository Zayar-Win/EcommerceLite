<?php

namespace App\Http\Controllers;

use App\Helpers\Uploader;
use App\Models\Order;
use App\Models\OrderProductDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{
    public $uploader;
    public function __construct()
    {
        $this->uploader  = new Uploader();
    }
    public function store()
    {
        $validatedData = request()->validate([
            'name' => ['required', 'min:2'],
            'phone' => ['required'],
            'email' => ['required', 'email'],
            'town' => ['required'],
            'shippingAddress' => ['required'],
            'password' => ['required', 'min:6'],
            'viber' => ['nullable'],
            'telegram' => ['nullable'],
            'fb_profile_link' => ['nullable'],
            'notes' => ['nullable'],
            'screenshot' => ['required'],
            'orderItems' => ['required'],
            'totalAmount' => ['required'],
            'payment_id' => ['required']
        ]);

        $user = User::where('email', $validatedData['email'])->first();

        if ($user) {
            $isPasswordCorrect = Hash::check($validatedData['password'], $user->password);
            if (!$isPasswordCorrect) {
                return back()->withErrors([
                    'password' => 'Your password is incorrect'
                ]);
            } else {
                Auth::login($user);
            }
        } else {
            $hashedPassword = Hash::make($validatedData['password']);
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'role_id' => 3,
                'phone' => $validatedData['phone'],
                'telegram' => $validatedData['telegram'],
                'viber' => $validatedData['viber'],
                'fb_profile_link' => $validatedData['fb_profile_link'],
                'address' => $validatedData['shippingAddress'],
                'password' => $hashedPassword
            ]);
            Auth::login($user);
        }

        $screenShotUrl = $this->uploader->upload($validatedData['screenshot'], 'screenshot');

        $order = Order::create([
            'user_id' => $user->id,
            'payment_id' => $validatedData['payment_id'],
            'status' => 'pending',
            'total_amount' =>  $validatedData['totalAmount'],
            'shipping_address' => $validatedData['shippingAddress'],
            'notes' => $validatedData['notes'],
            'screenshot' => $screenShotUrl,
            'shipping_ph_number' => $validatedData['phone']
        ]);

        for ($i = 0; $i < count($validatedData['orderItems']); $i++) {
            OrderProductDetail::create([
                'order_id' => $order->id,
                'product_detail_id' => $validatedData['orderItems'][$i]['product']['product_detail']['id'],
                'price' => $validatedData['orderItems'][$i]['product']['product_detail']['price'],
                'quantity' => $validatedData['orderItems'][$i]['product']['quantity'],
            ]);
        }
        Cache::put($user->id . "_celebrate", true, now()->addMinute());
        return redirect(route('celebrate'));
    }
}
