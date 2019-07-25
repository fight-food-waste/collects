<?php

use App\CollectionRound;
use App\Employee;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CollectionRoundsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CollectionRound::create([
            'round_date' => Carbon::tomorrow(),
            'user_id' => Employee::where('email', 'employee1@employee1.com')->value('id'),
            'warehouse_id' => 6,
        ]);

        CollectionRound::create([
            'round_date' => now(),
            'user_id' => Employee::where('email', 'employee2@employee2.com')->value('id'),
            'warehouse_id' => 2,
        ]);

        CollectionRound::create([
            'round_date' => Carbon::yesterday(),
            'started_at' => Carbon::yesterday(),
            'user_id' => Employee::where('email', 'employee3@employee3.com')->value('id'),
            'warehouse_id' => 3,
        ]);

        CollectionRound::create([
            'round_date' => Carbon::yesterday()->subWeekday(),
            'started_at' => Carbon::yesterday()->subWeekday(),
            'user_id' => Employee::where('email', 'employee4@employee4.com')->value('id'),
            'warehouse_id' => 4,
        ]);
    }
}
