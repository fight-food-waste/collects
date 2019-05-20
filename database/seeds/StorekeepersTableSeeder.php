<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StorekeepersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        User::create([
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName,
            'email' => 'toto@toto.com',
            'password' => Hash::make('qwertyuiop'),
            'address_id' => 1,
            'type' => 'storekeeper',
        ]);
    }
}
