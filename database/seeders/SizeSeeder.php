<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    
    public function run(): void
    {
        $sizes = [
            ['name' => 'Extra Small'],
            ['name' => 'Small'],
            ['name' => 'Medium'],
            ['name' => 'Large'],
            ['name' => 'X-Large'],
            ['name' => 'XX-Large'],
            ['name' => 'XXX-Large'],
        ];

        DB::table('sizes')->insert($sizes);
    }
}
