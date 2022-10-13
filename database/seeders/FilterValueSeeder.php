<?php

namespace Database\Seeders;

use App\Models\Filter;
use App\Models\FilterValue;
use Illuminate\Database\Seeder;

class FilterValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filterValues = [
            [
                'filter_id'     => Filter::where('filter_column', 'fabric')->first()->id,
                'filter_value'  => 'cotton'
            ],
            [
                'filter_id'     => Filter::where('filter_column', 'fabric')->first()->id,
                'filter_value'  => 'polyester'
            ],
        ];

        foreach ($filterValues as $filter) {
            if (is_null(FilterValue::where('filter_value', $filter['filter_value'])->first()))
                FilterValue::create($filter);
        }
    }
}