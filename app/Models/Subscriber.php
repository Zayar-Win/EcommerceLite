<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function scopeFilterBy($query, $filters)
    {
        return $query->when($filters['search'] ?? null, function ($query, $search) {
            return $query->where('email', 'LIKE', '%' . $search . '%');
        });
    }
}
