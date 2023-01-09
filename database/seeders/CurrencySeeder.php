<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currenciesRecords = [
            [
                'code'              => 'USA',
                'exchange_rate'     => 1,
            ],
            [
                'code'              => 'GBP',
                'exchange_rate'     => 1.26,
            ],
            [
                'code'              => 'EUR',
                'exchange_rate'     => 1.06,
            ],
            [
                'code'              => 'CAD',
                'exchange_rate'     => 0.79,
            ],
            [
                'code'              => 'AUD',
                'exchange_rate'     => 0.73,
            ],
        ];

        foreach ($currenciesRecords as $currency) {
            if (is_null(Currency::where('code', $currency['code'])->first())) {
                Currency::create($currency);
            }
        }
    }
}