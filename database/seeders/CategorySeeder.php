<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Section;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker      = Factory::create();
        $categories = [
            [
                'section_id'        => Section::where('name', 'clothes')->first()->id,
                'parent_id'         => 0,
                'name'              => 'men',
                'discount'          => 0,
                'description'       => $faker->sentence(100),
                'url'               => Str::slug('men', '-'),
                'meta_title'        => $faker->words(3, true),
                'meta_description'  => $faker->sentence(150),
                'meta_keywords'     => $faker->sentence(30),
                'status'            => rand(0, 1),
            ],
            [
                'section_id'        => Section::where('name', 'clothes')->first()->id,
                'parent_id'         => 0,
                'name'              => 'women',
                'discount'          => 0,
                'description'       => $faker->sentence(100),
                'url'               => Str::slug('women', '-'),
                'meta_title'        => $faker->words(3, true),
                'meta_description'  => $faker->sentence(150),
                'meta_keywords'     => $faker->sentence(30),
                'status'            => rand(0, 1),
            ],
            [
                'section_id'        => Section::where('name', 'clothes')->first()->id,
                'parent_id'         => 0,
                'name'              => 'kids',
                'discount'          => 0,
                'description'       => $faker->sentence(100),
                'url'               => Str::slug('kids', '-'),
                'meta_title'        => $faker->words(3, true),
                'meta_description'  => $faker->sentence(150),
                'meta_keywords'     => $faker->sentence(30),
                'status'            => rand(0, 1),
            ],
        ];

        foreach ($categories as $category) {
            if (is_null(Category::where('name', $category['name'])->first()))
                Category::create($category);
        }
    }
}