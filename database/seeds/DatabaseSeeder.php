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
             WarehousesTableSeeder::class,
             AddressesTableSeeder::class,
             StorekeepersTableSeeder::class,
             NeedyPeopleTableSeeder::class,
             EmployeesTableSeeder::class,
             DonorsTableSeeder::class,
             ShelvesTableSeeder::class,
             CollectionRoundsTableSeeder::class,
             BundlesTableSeeder::class,
             ProductsTableSeeder::class,
             TrucksTableSeeder::class,
         ]);
    }
}
