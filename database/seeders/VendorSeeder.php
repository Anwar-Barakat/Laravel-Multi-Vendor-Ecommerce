<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendor = [
            'name'          => 'Mohamed Khalof',
            'address'       => 'in the public avenue',
            'city'          => 'Yabroud',
            'state'         => 'Damascus',
            'country_id'    =>  Country::inRandomOrder()->first()->id,
            'pincode'       => '110001',
            'mobile'        => '0987654321',
            'email'         => 'khalof@gmail.com',
            'status'        => 0,
        ];

        if (is_null(Vendor::where(['email' => 'khalof@gmail.com'])->first()))
            Vendor::create($vendor);
    }
}