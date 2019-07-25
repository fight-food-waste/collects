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
            'email' => 'donor1@donor1.com',
            'password' => Hash::make('qwertyuiop'),
        ]);

        Donor::create([
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName,
            'email' => 'donor2@donor2.com',
            'password' => Hash::make('qwertyuiop'),
        ]);

        Donor::create([
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName,
            'email' => 'donor3@donor3.com',
            'password' => Hash::make('qwertyuiop'),
        ]);

        Donor::create([
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName,
            'email' => 'donor4@donor4.com',
            'password' => Hash::make('qwertyuiop'),
        ]);
    }
}
