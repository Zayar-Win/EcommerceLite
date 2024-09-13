<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function orderDetail(Order $order)
    {
        $order = Order::with('payment', 'orderProductDetails', 'orderProductDetails.productDetail', 'orderProductDetails.productDetail.product.images', 'orderProductDetails.productDetail.product.category')->where('id', $order->id)->with('orderProductDetails')->first();
        return Inertia::render('Admin/Orders/OrderDetail', [
            'order' => $order
        ]);
    }
}
