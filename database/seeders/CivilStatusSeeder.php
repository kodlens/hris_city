<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CivilStatusSeeder extends Seeder
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
                'civil_status' => 'SINGLE'
            ],
            [
                'civil_status' => 'MARRIED'
            ],
            [
                'civil_status' => 'WIDOWED'
            ],
            [
                'civil_status' => 'DIVORCED'
            ],
            [
                'civil_status' => 'SEPARATED'
            ],
        ];

        \App\Models\CivilStatus::insertOrIgnore($data);
    }
}
