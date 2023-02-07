<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
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
                'user_id' => 4,
                'company' => 'LEDA LAUNDRY SHOP',
                'owner' => 'LEDA GRACE',
                'overview' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus iusto repudiandae delectus. Esse officiis aspernatur, excepturi quaerat rem laboriosam ipsam?',
                'company_size' => 10,
                'industry' => 'LAUNDRY',
                'benefits_others' => 'SSS, PAGIBIG',
                'phone_contact' => '091654675224',
                'email' => 'employer@sample.com',
                'province' => 1042,
                'city' => 104215,
                'barangay' => 104215025,
                'street' => 'p-bougainvilla'
            ]
          
        ];

        \App\Models\Company::insertOrIgnore($data);
    }
}
