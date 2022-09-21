<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'name'              => 'Anwar Barakat',
                'type'              => 'superAdmin',
                'mobile'            => '0987654321',
                'email'             => 'brkatanwar0@gmail.com',
                'password'          => Hash::make('adminadmin'),
                'status'            => 1,
                'about_me'          => "Hi, Buddy. I am Anwar Barakat.Full Stack & Laravel Developer.",
                'vendor_id'         => Vendor::inRandomOrder()->first()->id,
            ],
            [
                'name'              => 'Mohamed Issa',
                'type'              => 'vendor',
                'mobile'            => '0987654321',
                'email'             => 'mohamed0@gmail.com',
                'password'          => Hash::make('adminadmin'),
                'status'            => 1,
                'about_me'          => "Hi, Buddy. I am Mohamed Issa.",
                'vendor_id'         => Vendor::inRandomOrder()->first()->id,
            ]
        ];

        foreach ($admins as $admin) {
            if (is_null(Admin::where(['email' => $admin['email']])->first()))
                Admin::create($admin);
        }
    }
}