<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProductDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attributeOptions()
    {
        return $this->belongsToMany(AttributeOption::class, 'attribute_option_product_detail', 'product_detail_id', 'attribute_option_id');
    }

    public function productDetail()
    {
        return $this->belongsTo(ProductDetail::class);
    }
}
