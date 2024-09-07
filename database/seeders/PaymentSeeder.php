<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payments')->insert([
            [
                'name' => 'Credit Card',
                'ph_number' => '09-751047472',
                'qr_code' => 'https://example.com/qr/credit-card.png',
                'icon' => 'https://example.com/icons/credit-card.png',
                'status' => 'active',
                'description' => 'Payment through major credit cards.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PayPal',
                'ph_number' => '09-751000001',
                'qr_code' => 'https://example.com/qr/paypal.png',
                'icon' => 'https://example.com/icons/paypal.png',
                'status' => 'active',
                'description' => 'Online payment through PayPal.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bank Transfer',
                'ph_number' => '123-456-7890',
                'qr_code' => 'https://example.com/qr/bank-transfer.png',
                'icon' => 'https://example.com/icons/bank-transfer.png',
                'status' => 'active',
                'description' => 'Direct bank transfer payment method.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cryptocurrency',
                'ph_number' => '09-777777772',
                'qr_code' => 'https://example.com/qr/crypto-code.png',
                'icon' => 'https://example.com/icons/crypto.png',
                'status' => 'active',
                'description' => 'Payment using various cryptocurrencies.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gift Card',
                'ph_number' => '09-444444444',
                'qr_code' => 'https://example.com/qr/gift-card.png',
                'icon' => 'https://example.com/icons/gift-card.png',
                'status' => 'active',
                'description' => 'Payment using store gift cards.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
