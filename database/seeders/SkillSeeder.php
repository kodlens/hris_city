<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
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
                'skill' => 'SOFTWARE ENGINEER',
            ],
            [
                'skill' => 'PROGRAMMER',
            ],
            [
                'skill' => 'MULTIMEDIA & ARTS',
            ],
            [
                'skill' => 'CARPENTER',
            ],
            [
                'skill' => 'MASON',
            ],
            [
                'skill' => 'WASHER',
            ],
            [
                'skill' => 'DRIVER',
            ],
            [
                'skill' => 'BACKHOE OPERATOR',
            ],
            [
                'skill' => 'DUMPTRUCK DRIVER',
            ],
            [
                'skill' => 'ACCOUNTANT',
            ],
            [
                'skill' => 'FINANCING',
            ],
        ];

        \App\Models\Skill::insertOrIgnore($data);


    }
}
