<?php

use App\Address;
use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 10; $i++) {
            Address::create([
                'street' => $faker->streetAddress,
                'city' => 'Paris',
//                'city' => $faker->city,
                'zip_postal_code' => '75000',
//                'zip_postal_code' => $faker->postcode,
                'user_id' => $i
            ]);
        }
    }
}
