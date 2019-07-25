<?php

use App\Shelf;
use Illuminate\Database\Seeder;

class ShelvesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 50 shelves for the 6 warehouses
        for ($i = 1; $i <= 6; $i++) {
            for ($j = 1; $j <= 50; $j++) {
                Shelf::create([
                    'number' => $j,
                    'warehouse_id' => $i,
                ]);
            }
        }
    }
}
