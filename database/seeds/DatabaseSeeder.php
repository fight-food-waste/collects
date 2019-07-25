<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             StorekeepersTableSeeder::class,
             NeedyPeopleTableSeeder::class,
             EmployeesTableSeeder::class,
             DonorsTableSeeder::class,
             AddressesTableSeeder::class,
             CollectionRoundsTableSeeder::class,
             BundlesTableSeeder::class,
             ProductsTableSeeder::class,
         ]);
    }
}
