<?php

use App\Product;
use Carbon\Carbon;
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
        // Products from a non validated bundle

        Product::create([
            'details' => "{}",
            'name' => "Brocolis - Vitavert - 500 g",
            'expiration_date' => Carbon::createFromFormat('d/m/Y', '29/07/2019')->toDateTimeString(),
            'barcode' => '3276559825549',
            'status' => 1,
            'bundle_id' => 1,
            'shelf_id' => null,
            'delivery_round_id' => null,
        ]);

        // Products to be collected

        Product::create([
            'details' => "{}",
            'name' => "Penne au Saumon, Crème d'épinards - Marie - 280 g",
            'expiration_date' => Carbon::createFromFormat('d/m/Y', '08/04/2021')->toDateTimeString(),
            'status' => 1,
            'barcode' => "3248832960025",
            'bundle_id' => 2,
            'shelf_id' => null,
            'delivery_round_id' => null,
        ]);

        // Products being collecting

        Product::create([
            'details' => "{}",
            'name' => "Compote Veloutée - St Mamet - 800 g",
            'expiration_date' => Carbon::createFromFormat('d/m/Y', '19/01/2020')->toDateTimeString(),
            'status' => 2,
            'barcode' => "3080920986650",
            'bundle_id' => 3,
            'shelf_id' => null,
            'delivery_round_id' => null,
        ]);

        // Collected stored

        Product::create([
            'details' => "{}",
            'name' => "PastaBox - Tortellini Ricotta Tomates Poivrons - Sodebo - 280 g",
            'expiration_date' => Carbon::createFromFormat('d/m/Y', '31/08/2019')->toDateTimeString(),
            'status' => 3,
            'barcode' => "3242272251255",
            'bundle_id' => 4,
            'shelf_id' => null,
            'delivery_round_id' => null,
        ]);
    }
}
