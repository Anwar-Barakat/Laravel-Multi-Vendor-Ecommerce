<?php

namespace Database\Seeders;

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
            'name'      => 'Anwar Barakat',
            'address'   => 'Beside the public garden',
            'city'      => 'Yabroud',
            'state'     => 'Damascus',
            'country'   => 'Syria',
            'pincode'   => '110001',
            'mobile'    => '0987654321',
            'email'     => 'brkatanwar0@gmail.com',
            'status'    => 0,
        ];

        if (is_null(Vendor::where(['email' => 'brkatanwar0@gmail.com'])->first()))
            Vendor::create($vendor);
    }
}
