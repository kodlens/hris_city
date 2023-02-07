<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CitizenshipSeeder extends Seeder
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
                'citizenship' => 'FILIPINO'
            ],
            [
                'citizenship' => 'AMERICAN'
            ],
            [
                'citizenship' => 'PALESTINE'
            ],
            [
                'citizenship' => 'INDIAN'
            ],
            [
                'citizenship' => 'CHINIESE'
            ],
            [
                'citizenship' => 'JAPANESE'
            ],
        ];

        \App\Models\Citizenship::insertOrIgnore($data);


    }
}
