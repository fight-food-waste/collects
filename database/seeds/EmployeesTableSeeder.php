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
        $faker = Faker\Factory::create('fr_FR');

        Employee::create([
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName,
            'email' => 'employee1@gmail.com',
            'password' => Hash::make('password'),
            'address_id' => 5,
        ]);

        Employee::create([
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName,
            'email' => 'employee2@gmail.com',
            'password' => Hash::make('password'),
            'address_id' => 6,
        ]);

        Employee::create([
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName,
            'email' => 'employee3@gmail.com',
            'password' => Hash::make('password'),
            'address_id' => 7,
        ]);

        Employee::create([
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName,
            'email' => 'employee4@gmail.com',
            'password' => Hash::make('password'),
            'address_id' => 8,
        ]);
    }
}
