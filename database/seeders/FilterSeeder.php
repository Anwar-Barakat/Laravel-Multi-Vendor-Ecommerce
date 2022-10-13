<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Filter;
use App\Models\Section;
use Illuminate\Database\Seeder;

class FilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clothing_id    = Section::where('name', 'clothes')->first()->id;
        $electronic_id  = Section::where('name', 'electronic')->first()->id;
        $filters = [
            [
                'category_ids'  => Category::where('section_id', $clothing_id)->pluck('id')->implode(','),
                'filter_name'   => 'Fabric',
                'filter_column' => 'fabric',
            ],
            [
                'category_ids'  => Category::where('section_id', $electronic_id)->pluck('id')->implode(','),
                'filter_name'   => 'Operating System',
                'filter_column' => 'operating-system',
            ],
        ];

        foreach ($filters as $filter) {
            if (is_null(Filter::where('filter_column', $filter['filter_column'])->first()))
                Filter::create($filter);
        }
    }
}