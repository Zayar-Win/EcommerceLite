<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_detail_id',
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

    public function scopeFilter($query, $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query)  use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                ;
            });
        });

        $query->when($filters['category'] ?? null, function ($query, $category) {
            $query->whereHas('category', function ($query) use ($category) {
                $query->where('name', $category);
            });
        });
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
