<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'username' => 'admin',
                'lname' => 'VARGAS',
                'fname' => 'CHARLES',
                'mname' => 'P',
                'sex' => 'MALE',

                'res_province' => 'MISAMIS OCCIDENTAL',
                'res_city' => 'TANGUB CITY',
                'res_barangay' => 'CANIANGAN',
                'res_street' => 'P-6',

                'per_province' => 'MISAMIS OCCIDENTAL',
                'per_city' => 'TANGUB CITY',
                'per_barangay' => 'CANIANGAN',
                'per_street' => 'P-6',

                'email' => 'admin@dev.com',
                'contact_no' => '09167789585',
                'role' => 'ADMINISTRATOR',
                'password' => Hash::make('a')
            ],

            //FACULTY
            [
                'username' => 'charles',
                'lname' => 'VARGAS',
                'fname' => 'CHARLES',
                'mname' => 'P',
                'sex' => 'MALE',

                'res_province' => 'MISAMIS OCCIDENTAL',
                'res_city' => 'TANGUB CITY',
                'res_barangay' => 'CANIANGAN',
                'res_street' => 'P-6',

                'per_province' => 'MISAMIS OCCIDENTAL',
                'per_city' => 'TANGUB CITY',
                'per_barangay' => 'CANIANGAN',
                'per_street' => 'P-6',

                'email' => 'charles@dev.com',
                'contact_no' => '09683014598',
                'role' => 'FACULTY',
                'password' => Hash::make('a')
            ],
        ];

        \App\Models\User::insertOrIgnore($data);
    }
}
