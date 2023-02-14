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
                'lname' => 'AMPARADO',
                'fname' => 'ETIENNE WAYNE',
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
                'username' => 'junrey',
                'lname' => 'SANTARITA',
                'fname' => 'JUNREY',
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

                'email' => 'junrey@dev.com',
                'contact_no' => '09167789584',
                'role' => 'FACULTY',
                'password' => Hash::make('a')
            ],
        ];

        \App\Models\User::insertOrIgnore($data);
    }
}
