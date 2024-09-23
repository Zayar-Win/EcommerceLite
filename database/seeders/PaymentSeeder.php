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
                'name' => 'Kbz',
                'username' => 'Zayarwin',
                'acc_number' => '09-751047472',
                'qr_code' => 'https://www.kbzbank.com/wp-content/uploads/2023/05/MRCS-QR-Copy-1.png?w=474',
                'icon' => 'https://tbqmall.co/wp-content/uploads/2023/09/tbqhs-kpay-checkout.png',
                'status' => 'active',
                'description' => 'Payment through major credit cards.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PayPal',
                'username' => 'Zayarwin',
                'acc_number' => '09-751000001',
                'qr_code' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSu0ekp4K8Yjf1Z5llljzD5ukVASrLE6pRAAg&s',
                'icon' => 'https://tbqmall.co/wp-content/uploads/2023/09/tbqhs-wavepay-checkout.png',
                'status' => 'active',
                'description' => 'Online payment through PayPal.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bank Transfer',
                'username' => 'Zayarwin',
                'acc_number' => '123-456-7890',
                'qr_code' => 'https://crown.edu.mm/wp-content/uploads/2024/01/AYAPay1-jpg.webp',
                'icon' => 'https://tbqmall.co/wp-content/uploads/2023/09/tbqhs-ayapay-checkout.png',
                'status' => 'active',
                'description' => 'Direct bank transfer payment method.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cryptocurrency',
                'username' => 'Zayarwin',
                'acc_number' => '09-777777772',
                'qr_code' => 'https://www.onepay.com/wp-content/uploads/2024/05/Section-2-1.png',
                'icon' => 'https://tbqmall.co/wp-content/uploads/2023/09/tbqhs-onepay-checkout.png',
                'status' => 'active',
                'description' => 'Payment using various cryptocurrencies.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gift Card',
                'username' => 'Zayarwin',
                'acc_number' => '09-444444444',
                'qr_code' => 'https://www.narrativeindustries.com/wp-content/uploads/2020/05/PayPal-QR-Code-Scan-Me-2-862x523.png',
                'icon' => 'https://tbqmall.co/wp-content/uploads/2023/09/tbqhs-uabpay-checkout.png',
                'status' => 'active',
                'description' => 'Payment using store gift cards.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
