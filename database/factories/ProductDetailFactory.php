<?php

namespace Database\Factories;

use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductDetailFactory extends Factory
{

    public function definition(): array
    {
        return [
            'size_id' => $this->faker->numberBetween(1, 7),
            'stock_quantity' => $this->faker->numberBetween(10, 100),
            'discount' => null,
            'price' => $this->faker->numberBetween(10000, 100000),
            'product_id' => $this->faker->numberBetween(1, 100)
        ];
    }
}
