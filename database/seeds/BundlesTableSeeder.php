<?php

use App\Bundle;
use App\BundleStatus;
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
            'bundle_status_id' => null,
            'user_id' => 4,
            'collection_round_id' => null,
        ]);

        // Bundle to be collected

        Bundle::create([
            'submitted_at' => Carbon::yesterday(),
            'validated_at' => now(),
            'bundle_status_id' => BundleStatus::where('name', 'To be collected')->first()->id,
            'user_id' => 4,
            'collection_round_id' => null,
        ]);

        // Bundle being collected

        Bundle::create([
            'submitted_at' => Carbon::yesterday(),
            'validated_at' => now(),
            'bundle_status_id' => BundleStatus::where('name', 'Being collected')->first()->id,
            'user_id' => 4,
            'collection_round_id' => CollectionRound::first()->id,
        ]);
    }
}
