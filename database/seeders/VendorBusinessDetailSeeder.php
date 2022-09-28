<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Vendor;
use App\Models\VendorBusinessDetail;
use Illuminate\Database\Seeder;

class VendorBusinessDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorBusinessDetail = [
            'vendor_id'                 => Vendor::inRandomOrder()->first()->id,
            'shop_name'                 => 'khalof shopping center',
            'shop_address'              => 'in the public avenue',
            'shop_city'                 => 'Yabroud',
            'shop_state'                => 'Damascus',
            'shop_country_id'           => Country::inRandomOrder()->first()->id,
            'shop_pincode'              => '11001',
            'shop_mobile'               => '0987654321',
            'shop_website'              => 'khalof-center.net',
            'shop_email'                => 'khalof@gmail.com',
            'address_proof'             => '1',
            'business_license_number'   => '123451231',
            'gst_number'                => '12312312123',
            'pan_number'                => '1512356671',
        ];

        if (is_null(VendorBusinessDetail::where(['shop_email' => 'khalof@gmail.com'])->first()))
            VendorBusinessDetail::create($vendorBusinessDetail);
    }
}