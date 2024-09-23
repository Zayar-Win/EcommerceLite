<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributSeeder extends Seeder
{
    public function run(): void
    {
        $attributes = [
            ['name' => 'Size'],
            ['name' => 'Color'],
            ['name' => 'Material'],
            ['name' => 'Brand'],
            ['name' => 'Weight']
        ];

        DB::table('attributes')->insert($attributes);
    }
}
