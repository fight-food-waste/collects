<?php

use App\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        Employee::create([
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName,
            'email' => 'employee1@employee1.com',
            'password' => Hash::make('qwertyuiop'),
            'address_id' => 1,
        ]);

        Employee::create([
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName,
            'email' => 'employee2@employee2.com',
            'password' => Hash::make('qwertyuiop'),
            'address_id' => 1,
        ]);

        Employee::create([
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName,
            'email' => 'employee3@employee3.com',
            'password' => Hash::make('qwertyuiop'),
            'address_id' => 1,
        ]);

        Employee::create([
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName,
            'email' => 'employee4@employee4.com',
            'password' => Hash::make('qwertyuiop'),
            'address_id' => 1,
        ]);
    }
}
