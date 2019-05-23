<?php

use App\ProductStatus;
use Illuminate\Database\Seeder;

class ProductStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductStatus::create([
            'name' => 'To be collected'
        ]);

        ProductStatus::create([
            'name' => 'Being collected'
        ]);

        ProductStatus::create([
            'name' => 'Stored'
        ]);

        ProductStatus::create([
            'name' => 'Delivered'
        ]);
    }
}
