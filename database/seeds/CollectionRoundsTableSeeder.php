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
            'user_id' => Employee::where('email', 'employee@employee.com')->first()->id,
        ]);
    }
}
