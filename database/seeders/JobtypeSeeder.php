<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JobtypeSeeder extends Seeder
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
                'jobtype' => 'WEEKLY',
            ],
            [
                'jobtype' => 'DAILY',
            ],
            [
                'jobtype' => 'MONTHLY',
            ],
            [
                'jobtype' => 'PARTIMER',
            ],
            [
                'jobtype' => 'PERMANENT',
            ],
            [
                'jobtype' => 'JOB ORDER',
            ],
        ];

        \App\Models\Jobtype::insertOrIgnore($data);
    }
}
