<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class QualificationSeeder extends Seeder
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
                'qualification' => 'NOT REQUIRED',
            ],
            [
                'qualification' => 'HIGH SCHOOL / SENIOR HIGH SCHOOL',
            ],
            [
                'qualification' => 'DIMPLOMA',
            ],
            [
                'qualification' => 'BACHELOR',
            ],
            [
                'qualification' => 'MASTER',
            ],
            [
                'qualification' => 'DOCTOR',
            ],
        ];

        \App\Models\Qualification::insertOrIgnore($data);

    }
}
