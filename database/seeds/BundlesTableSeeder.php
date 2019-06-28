<?php

use App\Bundle;
use App\CollectionRound;
use Carbon\Carbon;
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
        // Bundle to be validated

        Bundle::create([
            'submitted_at' => now(),
            'validated_at' => null,
            'status' => "open",
            'lifecycle_status' => 'no_validated',
            'user_id' => 7,
            'collection_round_id' => null,
        ]);

        // Bundle to be collected

        Bundle::create([
            'submitted_at' => Carbon::yesterday(),
            'validated_at' => now(),
            'status' => "open",
            'lifecycle_status' => 'to_collect',
            'user_id' => 8,
            'collection_round_id' => null,
        ]);

        // Bundle being collected

        Bundle::create([
            'submitted_at' => Carbon::yesterday(),
            'validated_at' => now(),
            'status' => "open",
            'lifecycle_status' => 'being_collected',
            'user_id' => 9,
            'collection_round_id' => CollectionRound::first()->id,
        ]);

        // Bundle collected

        Bundle::create([
            'submitted_at' => Carbon::yesterday()->subWeekday(),
            'validated_at' => Carbon::yesterday()->subWeekday(),
            'status' => "open",
            'lifecycle_status' => 'collected',
            'user_id' => 1,
            'collection_round_id' => 2,
        ]);
    }
}
