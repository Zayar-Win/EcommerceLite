<?php

namespace Database\Seeders;

use App\Models\ProductDetail;
use Database\Factories\ProductFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductDetailSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('product_details')->insert([
            [
                'size_id' => 1,
                'stock_quantity' => 100,
                'discount' => 10.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'size_id' => 2,
                'stock_quantity' => 150,
                'discount' => 5.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'size_id' => 3,
                'stock_quantity' => 200,
                'discount' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'size_id' => 4,
                'stock_quantity' => 180,
                'discount' => 15.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'size_id' => 5,
                'stock_quantity' => 120,
                'discount' => 8.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'size_id' => 6,
                'stock_quantity' => 110,
                'discount' => 12.50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'size_id' => 7,
                'stock_quantity' => 90,
                'discount' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'size_id' => 3,
                'stock_quantity' => 130,
                'discount' => 5.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'size_id' =>2,
                'stock_quantity' => 75,
                'discount' => 18.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'size_id' => 1,
                'stock_quantity' => 95,
                'discount' => 10.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'size_id' => 5,
                'stock_quantity' => 85,
                'discount' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'size_id' => 7,
                'stock_quantity' => 100,
                'discount' => 7.50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'size_id' => 6,
                'stock_quantity' => 160,
                'discount' => 20.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'size_id' => 4,
                'stock_quantity' => 140,
                'discount' => 13.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'size_id' => 2,
                'stock_quantity' => 105,
                'discount' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        ProductDetail::factory(20)->create();
    }
}
