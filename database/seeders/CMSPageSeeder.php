<?php

namespace Database\Seeders;

use App\Models\CmsPage;
use Illuminate\Database\Seeder;

class CMSPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cmsRecords = [
            [
                'title'             => 'About Us',
                'description'       => 'Content is coming soon',
                'url'               => 'about-us',
                'meta_title'        => 'About Us',
                'meta_description'  => 'About AN. Store',
                'meta_keywords'     => 'about us, about AN. store website',
            ],
            [
                'title'             => 'Privacy Policy',
                'description'       => 'Content is coming soon',
                'url'               => 'privacy-policy',
                'meta_title'        => 'Privacy Policy',
                'meta_description'  => 'About Privacy Policy of AN. store',
                'meta_keywords'     => 'privacy policy,privacy policy of AN. store',
            ],
        ];

        foreach ($cmsRecords as $cms) {
            if (is_null(CmsPage::where('title', $cms['title'])->first()))
                CmsPage::create($cms);
        }
    }
}