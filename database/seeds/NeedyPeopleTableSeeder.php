<?php

use App\NeedyPerson;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class NeedyPeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('fr_FR');

        NeedyPerson::create([
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName,
            'email' => 'needyperson1@gmail.com',
            'password' => Hash::make('password'),
            'address_id' => 9,
            'application_filename' => 'test.pdf',
        ]);
    }
}
