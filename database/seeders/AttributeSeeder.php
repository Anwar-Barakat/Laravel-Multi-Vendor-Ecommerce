<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_id = Product::inRandomOrder()->where('status', 1)->first()->id;

        $attribites = [
            [
                'product_id'    => $product_id,
                'size'          => 'small',
                'price'         => 100,
                'stock'         => 10,
                'sku'           => 'RT001-S',
            ],
            [
                'product_id'    => $product_id,
                'size'          => 'medium',
                'price'         => 120,
                'stock'         => 5,
                'sku'           => 'RT001-M',
            ],
            [
                'product_id'    => $product_id,
                'size'          => 'large',
                'price'         => 140,
                'stock'         => 20,
                'sku'           => 'RT001-L',
            ],
        ];

        foreach ($attribites as $attribute) {
            if (is_null(Attribute::where(['product_id' => $product_id, 'size' => $attribute['size']])->first()))
                Attribute::create($attribute);
        }
    }
}