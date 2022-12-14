<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker          = Factory::create();

        $section_id     = Section::where('name', 'clothes')->first()->id;
        $category_id    = Category::where('section_id', $section_id)->inRandomOrder()->first()->id;
        $brand_id       = Brand::inRandomOrder()->first()->id;
        $admin_id       = Admin::where('type', 'super-admin')->first()->id;

        $title          = 'black casual t-shirt';

        $product = [
            'section_id'        => $section_id,
            'category_id'       => $category_id,
            'brand_id'          => $brand_id,
            'admin_id'          => $admin_id,
            'name'              => $title,
            'code'              => rand(11111, 99999),
            'color'             => 'black',
            'price'             => rand(10, 30),
            'discount'          => 0,
            'weight'            => 10,
            'description'       => $faker->sentence(15),
            'meta_title'        => $faker->title,
            'meta_description'  => $faker->sentence(10),
            'meta_keywords'     => $faker->sentence(5),
            'is_featured'       => 'yes',
            'is_best_seller'    => true,
            'status'            => true,
        ];
        if (is_null(Product::where(['name' => $product['name']])->first()))
            Product::create($product);
    }
}