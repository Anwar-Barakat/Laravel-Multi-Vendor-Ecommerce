<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banners = [
            [
                'title'             => 'Spring Collection',
                'link'              => 'spring-collection',
                'alternative'       => 'Spring Collection',
                'status'            => '1'
            ],
            [
                'title'             => 'Tops',
                'link'              => 'tops',
                'alternative'       => 'Tops',
                'status'            => '1'
            ],
        ];

        foreach ($banners as $banner) {
            if (is_null(Banner::where('link', $banner['link'])->first()))
                Banner::create($banner);
        }
    }
}