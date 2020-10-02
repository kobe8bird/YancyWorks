<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();
        // Employee::delete();

        for($i = 0; $i < 100; $i++) {
            Employee::create([
                'firstname' => $faker->firstname,
                'lastname' => $faker->lastname,
                'email' => $faker->email,
                // 'phone' => $faker->phone,
                'company_id' => 0
            ]);
        }
    }
}
