<?php

namespace Database\Seeders;

use App\Models\Admin;
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
        $admin = [
            'name'              => 'Anwar Barakat',
            'type'              => 'superAdmin',
            'mobile'            => '0987654321',
            'email'             => 'brkatanwar0@gmail.com',
            'password'          => Hash::make('adminadmin'),
            'status'            => 1,
            'about_me'          => "Hi, Buddy. I am Anwar Barakat.Full Stack & Laravel Developer.",
            'vendor_id'         => 0,
        ];

        if (is_null(Admin::where(['email' => 'brkatanwar0@gmail.com'])->first()))
            Admin::create($admin);
    }
}
