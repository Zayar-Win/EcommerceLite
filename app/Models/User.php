<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'phone',
        'telegram',
        'viber',
        'fb_profile_link',
        'address',
        'dob',
        'email',
        'password',
        'role_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $with = ['role'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    protected function dob(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? date('Y-m-d', strtotime($value)) : null,
        );
    }

    public function scopeFilterBy(Builder $query, ?array $filterBy): Builder
    {
        return $query->when(isset($filterBy['search']), function ($query) use ($filterBy) {
            $search = $filterBy['search'];
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%');
            });
        });
    }
}
