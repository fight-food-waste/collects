<?php

use App\Bundle;
use App\BundleStatus;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Products to be collected

        Bundle::create([
            'submitted_at' => now(),
            'validated_at' => null,
            'bundle_status_id' => BundleStatus::where('name', 'To be collected')->first()->id,
            'user_id' => 4,
            'collection_round_id' => null,
        ]);
    }
}
