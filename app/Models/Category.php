<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function scopeFilterBy($query, $filters)
    {
        return $query->when($filters['search'] ?? null, function ($query) use ($filters) {
            $query->where('name', 'LIKE', '%' . $filters['search'] . '%');
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
