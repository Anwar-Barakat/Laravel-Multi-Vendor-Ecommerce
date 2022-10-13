<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CountrySeeder::class,
            VendorSeeder::class,
            AdminSeeder::class,
            VendorBusinessDetailSeeder::class,
            VendorBankDetailSeeder::class,

            SectionSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            BannerSeeder::class,

            ProductSeeder::class,
            AttributeSeeder::class,
        ]);
    }
}