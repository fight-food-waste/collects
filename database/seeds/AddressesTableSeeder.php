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
        $faker = Faker\Factory::create();

        Address::create([
            'street' => $faker->streetAddress,
            'city' => $faker->city,
            'zip_postal_code' => $faker->postcode,
        ]);

        Address::create([
            'street' => $faker->streetAddress,
            'city' => $faker->city,
            'zip_postal_code' => $faker->postcode,
        ]);

        Address::create([
            'street' => $faker->streetAddress,
            'city' => $faker->city,
            'zip_postal_code' => $faker->postcode,
        ]);

        Address::create([
            'street' => $faker->streetAddress,
            'city' => $faker->city,
            'zip_postal_code' => $faker->postcode,
        ]);
    }
}
