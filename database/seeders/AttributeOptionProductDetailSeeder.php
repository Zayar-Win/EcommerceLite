<?php

namespace Database\Seeders;

use App\Models\AttributeOptionProductDetail;
use Illuminate\Database\Seeder;

class AttributeOptionProductDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AttributeOptionProductDetail::factory(20)->create();
    }
}
