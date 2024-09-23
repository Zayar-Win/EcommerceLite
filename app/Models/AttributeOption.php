<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function productDetails()
    {
        return $this->belongsToMany(ProductDetail::class, 'attribute_option_product_detail', 'attribute_option_id', 'product_detail_id');
    }
}
