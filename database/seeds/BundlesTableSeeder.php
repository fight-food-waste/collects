<?php

use App\Bundle;
use Illuminate\Database\Seeder;

class BundlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bundle::create([
            'status' => 0,
            'user_id' => 7,
            'collection_round_id' => null,
        ]);

        Bundle::create([
            'status' => 0,
            'user_id' => 8,
            'collection_round_id' => null,
        ]);

        Bundle::create([
            'status' => 0,
            'user_id' => 9,
            'collection_round_id' => null,
        ]);

        Bundle::create([
            'status' => 0,
            'user_id' => 10,
            'collection_round_id' => null,
        ]);
    }
}
