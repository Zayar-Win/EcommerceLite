<?php

namespace Database\Factories;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    
    protected static ?string $password;

   
    public function definition(): array
    {
        return [
            'role_id' => Role::where('name', 'user')->firstOrFail()->id,
            'name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'telegram' => fake()->userName(),
            'viber' => fake()->userName(),
            'address' => fake()->address(),
            'fb_profile_link' => $this->faker->url(),
            'dob' => $this->faker->dateTimeBetween('2000-01-01', '2005-12-31')->format('Y-m-d'),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'created_at' => fake()->dateTimeBetween(Carbon::now()->startOfYear(), now()),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
