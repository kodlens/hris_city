<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class JobPostSeeder extends Seeder
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
                'company_id' => 1,
                'title' => 'LF: LABANDERA',
                'job_desc' => '<p>Kanang dili tapulan ug reklamado, kanang dili alergy ug sabon.</p>',
                'minimum_qualification' => 'NOT REQUIRED',
                'minimum_experience' => 'Below 1 Year',
                'jobtype_id' => 2,
                'category_id' => 10,
                'from_salary' => 150,
                'to_salary' => 200,
                'province' => 1042,
                'city' => 104215,
                'barangay' => 104215025,
                'street' => 'p-bougainvilla'

            ],

            [
                'company_id' => 1,
                'title' => 'PROGRAMMER PROJECT BASE',
                'job_desc' => '<p>Project Base Programmer</p><p><br></p><p>Looking for a programmer. Kanang less surpervision and can do the task.</p><p><br></p><p><strong>Requirements</strong></p><ul><li>taas logic</li><li>BSCS/IT graduate or any related programs</li><li>Good Manners</li><li>Good Communication Skill</li></ul>',
                'minimum_qualification' => 'BACHELOR',
                'minimum_experience' => '1 - 3 Years',
                'jobtype_id' => 6,
                'category_id' => 9,
                'from_salary' => 20000,
                'to_salary' => 30000,
                'province' => 1042,
                'city' => 104215,
                'barangay' => 104215025,
                'street' => ''

            ],
            
        ];

        \App\Models\JobPost::insertOrIgnore($data);


    }
}
