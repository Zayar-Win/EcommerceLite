<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeOptionProductDetail extends Model
{
    protected $guarded = [];
    protected $table = 'attribute_option_product_detail';
    use HasFactory;


    public function attributeOption()
    {
        return $this->belongsTo(AttributeOption::class);
    }
}
