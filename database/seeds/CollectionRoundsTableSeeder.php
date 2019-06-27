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
            'user_id' => Employee::where('email', 'employee1@employee1.com')->first()->id,
        ]);

        CollectionRound::create([
            'round_date' => Carbon::now(),
            'user_id' => Employee::where('email', 'employee2@employee2.com')->first()->id,
        ]);

        CollectionRound::create([
            'round_date' => Carbon::yesterday(),
            'started_at' => Carbon::yesterday(),
            'user_id' => Employee::where('email', 'employee3@employee3.com')->first()->id,
        ]);

        CollectionRound::create([
            'round_date' => Carbon::yesterday()->subWeekday(),
            'started_at' => Carbon::yesterday()->subWeekday(),
            'is_completed' => true,
            'user_id' => Employee::where('email', 'employee4@employee4.com')->first()->id,
        ]);
    }
}
