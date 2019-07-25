<?php

use App\Warehouse;
use Illuminate\Database\Seeder;

class WarehousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Warehouse::create([
            'name' => 'Lilles',
            'address' => '14 Rue de Fleurus, 59000 Lille, France',
        ]);

        Warehouse::create([
            'name' => 'Nancy',
            'address' => '46 Avenue de la Libération, 54015 Nancy, France',
        ]);

        Warehouse::create([
            'name' => 'Lyon',
            'address' => '4 Rue Jussieu, 69002 Lyon, France',
        ]);

        Warehouse::create([
            'name' => 'Marseille',
            'address' => '19 Rue Grignan, 13006 Marseille, France',
        ]);

        Warehouse::create([
            'name' => 'Limoges',
            'address' => 'Rue de la Chabeaudie, 87100 Limoges, France',
        ]);

        Warehouse::create([
            'name' => 'Nantes',
            'address' => '16 Rue Dufour, 44000 Nantes, France',
        ]);

        Warehouse::create([
            'name' => 'Paris',
            'address' => '220 Rue du Faubourg Saint-Antoine, 75012 Paris'
        ]);
    }
}
