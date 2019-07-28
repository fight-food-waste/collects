<?php

use App\Storekeeper;
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
        $faker = Faker\Factory::create('fr_FR');

        Storekeeper::create([
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName,
            'email' => 'store@store.com',
            'password' => Hash::make('qwertyuiop'),
            'address_id' => 10,
        ]);
    }
}
