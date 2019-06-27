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
            'line_1' => $faker->streetAddress,
            'line_2' => $faker->secondaryAddress,
            'line_3' => $faker->secondaryAddress,
            'city' => $faker->city,
            'county_province' => $faker->country,
            'region' => $faker->state,
            'zip_postal_code' => $faker->postcode,
            'country' => $faker->state,
        ]);

        Address::create([
            'line_1' => $faker->streetAddress,
            'line_2' => $faker->secondaryAddress,
            'line_3' => $faker->secondaryAddress,
            'city' => $faker->city,
            'county_province' => $faker->country,
            'region' => $faker->state,
            'zip_postal_code' => $faker->postcode,
            'country' => $faker->state,
        ]);

        Address::create([
            'line_1' => $faker->streetAddress,
            'line_2' => $faker->secondaryAddress,
            'line_3' => $faker->secondaryAddress,
            'city' => $faker->city,
            'county_province' => $faker->country,
            'region' => $faker->state,
            'zip_postal_code' => $faker->postcode,
            'country' => $faker->state,
        ]);

        Address::create([
            'line_1' => $faker->streetAddress,
            'line_2' => $faker->secondaryAddress,
            'line_3' => $faker->secondaryAddress,
            'city' => $faker->city,
            'county_province' => $faker->country,
            'region' => $faker->state,
            'zip_postal_code' => $faker->postcode,
            'country' => $faker->state,
        ]);
    }
}
