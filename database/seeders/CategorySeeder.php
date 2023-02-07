<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
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
                'category' => 'SALES CLERK',
            ],
            [
                'category' => 'CONSTRUCTION WORKERS',
            ],
            [
                'category' => 'DELIVERY SERVICES',
            ],
            [
                'category' => 'HOUSE WORKERS',
            ],
            [
                'category' => 'DRIVERS',
            ],
            [
                'category' => 'MECHANIC',
            ],
            [
                'category' => 'SERVICE CREW',
            ],
            [
                'category' => 'OFFICE CLERK',
            ],
            [
                'category' => 'FREELANCER',
            ],
            [
                'category' => 'UTILITY WORKERS',
            ],
            [
                'category' => 'CUSTOMER SERVICE',
            ],
            [
                'category' => 'FARMERS',
            ],
            [
                'category' => 'OTHERS',
            ],
        ];

        \App\Models\Category::insertOrIgnore($data);


    }
}
