<?php

use App\CollectionRound;
use App\Employee;
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
            'user_id' => Employee::where('email', 'employee1@employee1.com')->value('id'),
            'warehouse_id' => 6,
        ]);

        CollectionRound::create([
            'user_id' => Employee::where('email', 'employee2@employee2.com')->value('id'),
            'warehouse_id' => 2,
        ]);

        CollectionRound::create([
            'user_id' => Employee::where('email', 'employee3@employee3.com')->value('id'),
            'warehouse_id' => 3,
        ]);

        CollectionRound::create([
            'user_id' => Employee::where('email', 'employee4@employee4.com')->value('id'),
            'warehouse_id' => 4,
        ]);
    }
}
