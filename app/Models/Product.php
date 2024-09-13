<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'product_detail_id',
        'category_id',
        'name',
        'description',
        'discount',
        'priority',
        'slug',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function scopeFilterBy(Builder $query, ?array $filterBy): Builder
    {
        return $query->when(isset($filterBy['search']), function ($query) use ($filterBy) {
            $search = $filterBy['search'];
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('price', 'like', '%' . $search . '%');
            });
        })->when(isset($filterBy['category']), function ($query) use ($filterBy) {
            $query->whereHas('category', function($query) use ($filterBy) {
                $query->where('name', 'like', '%' . $filterBy['category'] . '%');
            });
        });
    }
}
