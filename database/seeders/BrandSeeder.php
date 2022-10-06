<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            [
                'name'              => 'Nike',
                'status'            => rand(0, 1),
            ],
            [
                'name'              => 'Arrow',
                'status'            => rand(0, 1),
            ],
            [
                'name'              => 'Gap',
                'status'            => rand(0, 1),
            ],
            [
                'name'              => 'Lee',
                'status'            => rand(0, 1),
            ],
            [
                'name'              => 'Samsung',
                'status'            => rand(0, 1),
            ],
            [
                'name'              => 'Apple',
                'status'            => rand(0, 1),
            ],
            [
                'name'              => 'MI',
                'status'            => rand(0, 1),
            ],
            [
                'name'              => 'Lenovo',
                'status'            => rand(0, 1),
            ],
            [
                'name'              => 'ASUS',
                'status'            => rand(0, 1),
            ],
            [
                'name'              => 'DELL',
                'status'            => rand(0, 1),
            ],
        ];

        foreach ($brands as $brand) {
            if (is_null(Brand::where('name', $brand['name'])->first()))
                Brand::create($brand);
        }
    }
}