<?php

use App\CollectionRound;
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
             AddressesTableSeeder::class,
             StorekeepersTableSeeder::class,
             NeedyPeopleTableSeeder::class,
             EmployeesTableSeeder::class,
             DonorsTableSeeder::class,
             BundleStatusesTableSeeder::class,
             ProductStatusesTableSeeder::class,
             CollectionRoundsTableSeeder::class,
             BundlesTableSeeder::class,
         ]);
    }
}
