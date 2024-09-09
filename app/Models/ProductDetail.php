<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'size_id',
        'stock_quantity',
        'discount',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function size()
    {
        return $this->belongsTo(Size::class,'size_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'image');
    }
}
