<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'user_id' => 1,
                'payment_id' => 1,
                'status' => 'pending',
                'total_amount' => 150.00,
                'shipping_address' => '123 Main St, New York, NY',
                'notes' => 'Leave at the front door.',
                'screenshort' => null,
                'shipping_recipient_name' => 'John Doe',
                'shipping_ph_number' => '123-456-7890',
                'delivery_date' => now()->addDays(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'payment_id' => 2,
                'status' => 'pending',
                'total_amount' => 200.00,
                'shipping_address' => '456 Elm St, Los Angeles, CA',
                'notes' => 'Ring the doorbell.',
                'screenshort' => null,
                'shipping_recipient_name' => 'Jane Smith',
                'shipping_ph_number' => '987-654-3210',
                'delivery_date' => now()->addDays(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'payment_id' => 3,
                'status' => 'pending',
                'total_amount' => 250.00,
                'shipping_address' => '789 Maple St, Chicago, IL',
                'notes' => 'Call when arriving.',
                'screenshort' => null,
                'shipping_recipient_name' => 'Sam Wilson',
                'shipping_ph_number' => '555-555-5555',
                'delivery_date' => now()->addDays(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
