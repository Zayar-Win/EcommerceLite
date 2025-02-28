<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'size_id',
        'stock_quantity',
        'price',
        'discount',
    ];

    public function attributeOptions()
    {
        return $this->belongsToMany(AttributeOption::class, 'attribute_option_product_detail', 'product_detail_id', 'attribute_option_id');
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'image');
    }

    public function scopeFilterBy(Builder $query, ?array $filterBy): Builder
    {
        return $query->when(isset($filterBy['search']), function ($query) use ($filterBy) {
            $search = $filterBy['search'];
            $query->where(function ($query) use ($search) {
                $query->where('price', 'like', '%' . $search . '%');
            });
        });
    }
}
