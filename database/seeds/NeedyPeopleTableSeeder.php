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
            'email' => 'needy@needy.com',
            'password' => Hash::make('qwertyuiop'),
            'aid_application_id' => null,
        ]);
    }
}
