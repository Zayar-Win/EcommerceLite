<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderProductDetailSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('order_product_details')->insert([
            // Order 1 (User 1)
            [
                'order_id' => 1,
                'product_detail_id' => 1,  
                'price' => 30.00,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 1,
                'product_detail_id' => 2,
                'price' => 40.00,
                'quantity' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 1,
                'product_detail_id' => 3,
                'price' => 20.00,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 1,
                'product_detail_id' => 4,
                'price' => 35.00,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 1,
                'product_detail_id' => 5,
                'price' => 25.00,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Order 2 (User 2)
            [
                'order_id' => 2,
                'product_detail_id' => 6,
                'price' => 45.00,
                'quantity' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'product_detail_id' => 7,
                'price' => 30.00,
                'quantity' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'product_detail_id' => 8,
                'price' => 25.00,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'product_detail_id' => 9,
                'price' => 50.00,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'product_detail_id' => 10,
                'price' => 40.00,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Order 3 (User 3)
            [
                'order_id' => 3,
                'product_detail_id' => 11,
                'price' => 60.00,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 3,
                'product_detail_id' => 12,
                'price' => 35.00,
                'quantity' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 3,
                'product_detail_id' => 13,
                'price' => 45.00,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 3,
                'product_detail_id' => 14,
                'price' => 55.00,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 3,
                'product_detail_id' => 15,
                'price' => 30.00,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
