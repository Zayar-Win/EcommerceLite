<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::factory(100)->create();

        for ($i = 0; $i < 100; $i++) {
            Image::factory()->create([
                'imageable_id' => $i + 1,
                'url' => 'https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a67c4666f047ada3ba87_image-10-shop-product-shopwave-template-p-500.png'
            ]);
            Image::factory()->create([
                'imageable_id' => $i + 1,
                'url' => 'https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a777d6557d526b9dba47_image-12-shop-product-shopwave-template.png'
            ]);
            Image::factory()->create([
                'imageable_id' => $i + 1,
                'url' => 'https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f697b6ea32fefb0084af2c_more-image-3-shop-product-shopwave-template.png'
            ]);
        }
    }
}
