<?php

use App\BundleStatus;
use Illuminate\Database\Seeder;

class BundleStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BundleStatus::create([
            'name' => 'To be collected'
        ]);

        BundleStatus::create([
            'name' => 'Being collected'
        ]);

        BundleStatus::create([
            'name' => 'Stored'
        ]);

        BundleStatus::create([
            'name' => 'Delivered'
        ]);
    }
}
