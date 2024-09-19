<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\ProductDetail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{

    public function definition(): array
    {
        return [
            'category_id' => $this->faker->numberBetween(1, 5),
            'name' => $this->faker->unique()->words(3, true),
            'description' => $this->faker->paragraph(),
            'discount' => $this->faker->numberBetween(0, 100),
            'priority' => null,
            'slug' => Str::slug($this->faker->unique()->words(3, true)),
            'created_at' => now(),
            'updated_at' => now(),
            'price' => $this->faker->numberBetween(10000, 100000)
        ];
    }
}
