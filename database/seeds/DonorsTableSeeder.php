<?php

use App\Donor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DonorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('fr_FR');

        Donor::create([
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName,
            'email' => 'donor1@gmail.com',
            'password' => Hash::make('password'),
            'address_id' => 1,
        ]);

        Donor::create([
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName,
            'email' => 'donor2@gmail.com',
            'password' => Hash::make('password'),
            'address_id' => 2,
        ]);

        Donor::create([
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName,
            'email' => 'donor3@gmail.com',
            'password' => Hash::make('password'),
            'address_id' => 3,
        ]);

        Donor::create([
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName,
            'email' => 'donor4@gmail.com',
            'password' => Hash::make('password'),
            'address_id' => 4,
        ]);
    }
}
