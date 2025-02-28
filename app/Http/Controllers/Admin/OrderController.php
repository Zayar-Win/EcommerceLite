<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function orderDetail(Order $order)
    {
        $order = Order::with('user', 'payment', 'orderProductDetails', 'orderProductDetails.productDetail', 'orderProductDetails.productDetail.product.images', 'orderProductDetails.productDetail.product.category', 'orderProductDetails.productDetail.attributeOptions', 'orderProductDetails.productDetail.attributeOptions.attribute')->where('id', $order->id)->with('orderProductDetails')->first();
        return Inertia::render('Admin/Orders/OrderDetail', [
            'order' => $order
        ]);
    }

    public function update(Order $order)
    {
        // if ($order->status == 'completed') {
        //     return back()->with('success', 'Your order is already completed.');
        // }
        $orderProductDetails = $order->orderProductDetails()->with('productDetail', 'productDetail.product')->get();

        $outStocksProductDetails = [];
        foreach ($orderProductDetails as $orderProductDetail) {
            if ($orderProductDetail->productDetail->stock_quantity < $orderProductDetail->quantity) {
                $outStocksProductDetails[] = $orderProductDetail;
            }
        }
        if (count($outStocksProductDetails)) {
            $errorMessage = '';
            foreach ($orderProductDetails as $orderProductDetail) {
                if ($errorMessage) {
                    $errorMessage = $errorMessage . ' and ' . $orderProductDetail->productDetail->proudct->name;
                } else {
                    $errorMessage = $orderProductDetail->productDetail->product->name;
                }
            }
            $errorMessage = $errorMessage . ' don\'t have enough stock';
            return back()->with('error', $errorMessage);
        }
        $order->update([
            'status' => 'completed'
        ]);
        foreach ($orderProductDetails as $orderProductDetail) {
            $orderProductDetail->productDetail->update([
                'stock_quantity' => $orderProductDetail->productDetail->stock_quantity - $orderProductDetail->quantity
            ]);
        }
        return back()->with('success', 'Order update successful.');
    }
}
