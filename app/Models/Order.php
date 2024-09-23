<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_id',
        'status',
        'total_amount',
        'shipping_address',
        'notes',
        'screenshot',
        'shipping_recipient_name',
        'shipping_ph_number',
        'delivery_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderProductDetails()
    {
        return $this->hasMany(OrderProductDetail::class, 'order_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function productDetails()
    {
        return $this->belongsToMany(ProductDetail::class)
            ->withPivot('quantity', 'price')
            ->withTimestamps();;
    }
}
