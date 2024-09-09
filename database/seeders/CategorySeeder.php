<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Beauty',
                'slug' => Str::slug('Beauty'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Clothes',
                'slug' => Str::slug('Clothes'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Electronic & IT',
                'slug' => Str::slug('Electronic & IT'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Food',
                'slug' => Str::slug('Food'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Daily Life Goods',
                'slug' => Str::slug('Daily Life Goods'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
