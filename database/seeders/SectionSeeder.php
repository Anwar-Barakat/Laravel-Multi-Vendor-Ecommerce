<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = [
            'Clothes',
            'Electronic',
            'Appliances',
        ];

        foreach ($sections as $section) {
            if (is_null(Section::where('name', $section)->first()))
                Section::create(['name' => $section]);
        }
    }
}