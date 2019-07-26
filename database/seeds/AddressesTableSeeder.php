<?php

use App\Address;
use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Address::create([
            'street' => '18 Rue Thérèse',
            'city' => 'Paris',
            'zip_postal_code' => '75002',
            'user_id' => 1,
            'closest_warehouse_id' => 7,
        ]);

        Address::create([
            'street' => '5 Rue Daubenton',
            'city' => 'Paris',
            'zip_postal_code' => '75005',
            'user_id' => 2,
            'closest_warehouse_id' => 7,
        ]);

        Address::create([
            'street' => '19 Boulevard Montebello',
            'city' => 'Lille',
            'zip_postal_code' => '59000',
            'user_id' => 3,
            'closest_warehouse_id' => 1,
        ]);

        Address::create([
            'street' => '57 Rue Saint-Dizier',
            'city' => 'Nancy',
            'zip_postal_code' => '54000',
            'user_id' => 4,
            'closest_warehouse_id' => 2,
        ]);

        Address::create([
            'street' => '41 Rue Antoine Lumière',
            'city' => 'Lyon',
            'zip_postal_code' => '69372',
            'user_id' => 5,
            'closest_warehouse_id' => 3,
        ]);

        Address::create([
            'street' => '12 Rue Urbain V',
            'city' => 'Marseille',
            'zip_postal_code' => '13002',
            'user_id' => 6,
            'closest_warehouse_id' => 4,
        ]);

        Address::create([
            'street' => '123 Avenue Albert Thomas',
            'city' => 'Limoges',
            'zip_postal_code' => '87000',
            'user_id' => 7,
            'closest_warehouse_id' => 5,
        ]);

        Address::create([
            'street' => '30 Rue du Calvaire de Grillaud',
            'city' => 'Nantes',
            'zip_postal_code' => '44000',
            'user_id' => 8,
            'closest_warehouse_id' => 6,
        ]);

        Address::create([
            'street' => '8 Rue Général Buat',
            'city' => 'Nantes',
            'zip_postal_code' => '44000',
            'user_id' => 9,
            'closest_warehouse_id' => 6,
        ]);

        Address::create([
            'street' => '17 Rue des Chartreux',
            'city' => 'Lyon',
            'zip_postal_code' => '690001',
            'user_id' => 10,
            'closest_warehouse_id' => 3,
        ]);
    }
}
