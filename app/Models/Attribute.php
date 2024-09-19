<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function attributeOptions()
    {
        return $this->hasMany(AttributeOption::class);
    }

    public function scopeFilterBy(Builder $query, ?array $filterBy): Builder
    {
        return $query->when(isset($filterBy['search']),function($query) use ($filterBy){
            $search = $filterBy['search'];
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
        });
    }
}
