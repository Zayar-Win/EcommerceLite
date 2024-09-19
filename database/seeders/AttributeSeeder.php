<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\AttributeOptionProductDetail;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['color', 'size', 'storage', 'brand'];
        $options = [
            'color' => ['red', 'green', 'blue', 'black'],
            'size' => ['lg', 'xl', 'md', 'xxl'],
            'storage' => ['128gb', '256gb', '528gb', '1TB'],
            'brand' => ['LV', 'Lee', 'Gucci', 'Uni']
        ];

        $products = [
            'clothes' => [
                'name' => 'T-shirt',
                'attributes' => ['color', 'size', 'brand']
            ],
            'phones' => [
                'name' => 'IPhone',
                'attributes' => [
                    'color',
                    'storage',
                ]
            ],
        ];

        foreach ($names as $name) {
            $attribute = Attribute::factory()->create([
                'name' => $name
            ]);
            foreach ($options[$name] as $value) {
                AttributeOption::factory()->create([
                    'value' => $value,
                    'attribute_id' => $attribute->id
                ]);
            }
        }

        foreach ($products as $key => $value) {
            foreach ([0, 0, 0, 0, 0, 0, 0, 0, 0] as $i) {
                $product = Product::factory()->create();
                Image::factory()->create([
                    'imageable_id' => $product->id,
                    'url' => 'https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a67c4666f047ada3ba87_image-10-shop-product-shopwave-template-p-500.png'
                ]);
                Image::factory()->create([
                    'imageable_id' => $product->id,
                    'url' => 'https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f6a777d6557d526b9dba47_image-12-shop-product-shopwave-template.png'
                ]);
                Image::factory()->create([
                    'imageable_id' => $product->id,
                    'url' => 'https://cdn.prod.website-files.com/62f51a90d298e65b94bbffcd/62f697b6ea32fefb0084af2c_more-image-3-shop-product-shopwave-template.png'
                ]);

                foreach ([0, 1, 2, 3] as $i) {
                    $productDetail = ProductDetail::factory()->create([
                        'product_id' => $product->id
                    ]);
                    $sizeAttribute = Attribute::where('name', 'size')->first();
                    $sizeOptions = AttributeOption::where('attribute_id', $sizeAttribute->id)->get();

                    $colorAttribute = Attribute::where('name', 'color')->first();
                    $colorOptions = AttributeOption::where('attribute_id', $colorAttribute->id)->get();

                    $brandAttribute = Attribute::where('name', 'brand')->first();
                    $brandOptions = AttributeOption::where('attribute_id', $brandAttribute->id)->get();

                    $storageAttribute = Attribute::where('name', 'storage')->first();
                    $storageOptions = AttributeOption::where('attribute_id', $storageAttribute->id)->get();

                    if ($key == 'clothes') {
                        foreach ([0, 1, 2, 3] as $i) {
                            AttributeOptionProductDetail::factory()->create([
                                'product_detail_id' => $productDetail->id,
                                'attribute_option_id' => $sizeOptions[rand(0, count($sizeOptions) - 1)]->id
                            ]);
                            AttributeOptionProductDetail::factory()->create([
                                'product_detail_id' => $productDetail->id,
                                'attribute_option_id' => $colorOptions[rand(0, count($colorOptions) - 1)]->id
                            ]);
                            AttributeOptionProductDetail::factory()->create([
                                'product_detail_id' => $productDetail->id,
                                'attribute_option_id' => $brandOptions[rand(0, count($brandOptions) - 1)]->id
                            ]);
                        }
                    }
                    if ($key == 'phones') {
                        foreach ([0, 1, 2, 3] as $i) {
                            AttributeOptionProductDetail::factory()->create([
                                'product_detail_id' => $productDetail->id,
                                'attribute_option_id' => $colorOptions[rand(0, count($colorOptions) - 1)]->id
                            ]);
                            AttributeOptionProductDetail::factory()->create([
                                'product_detail_id' => $productDetail->id,
                                'attribute_option_id' => $storageOptions[rand(0, count($storageOptions) - 1)]->id
                            ]);
                        }
                    }
                }
            }
        }
    }
}
