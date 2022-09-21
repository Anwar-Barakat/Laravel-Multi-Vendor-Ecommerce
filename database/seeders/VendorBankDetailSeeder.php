<?php

namespace Database\Seeders;

use App\Models\Vendor;
use App\Models\VendorBankDetail;
use Illuminate\Database\Seeder;

class VendorBankDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorBankDetail = [
            'vendor_id'                 => Vendor::inRandomOrder()->first()->id,
            'account_holder_name'       => 'Mohamed Khalof',
            'bank_name'                 => 'Al-Baraka',
            'account_number'            => '1231231231',
            'bank_ifsc_code'            => '11231-123123',
        ];

        if (is_null(VendorBankDetail::where(['account_holder_name' => 'Mohamed Khalof'])->first()))
            VendorBankDetail::create($vendorBankDetail);
    }
}