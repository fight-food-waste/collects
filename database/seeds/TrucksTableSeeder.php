<?php

use App\Truck;
use Illuminate\Database\Seeder;

class TrucksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 7; $i++) {
            Truck::create([
                'warehouse_id' => $i,
            ]);
        }
    }
}
