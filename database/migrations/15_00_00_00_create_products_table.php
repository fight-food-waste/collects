<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->json('details');

            $table->date('expiration_date');

            $table->unsignedBigInteger('product_status_id');
            $table->foreign('product_status_id')->references('id')->on('product_statuses');

            $table->unsignedBigInteger('bundle_status_id');
            $table->foreign('bundle_status_id')->references('id')->on('bundle_statuses');

            $table->unsignedBigInteger('shelf_id');
            $table->foreign('shelf_id')->references('id')->on('shelves');

            $table->unsignedBigInteger('delivery_round_id');
            $table->foreign('delivery_round_id')->references('id')->on('delivery_rounds');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
