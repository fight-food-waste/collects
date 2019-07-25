<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('barcode');
            $table->string('name');

            $table->unsignedBigInteger('bundle_id');
            $table->foreign('bundle_id')->references('id')->on('bundles');

            $table->unsignedBigInteger('shelf_id')->nullable();
            $table->foreign('shelf_id')->references('id')->on('shelves');

            $table->unsignedBigInteger('delivery_round_id')->nullable();
            $table->foreign('delivery_round_id')->references('id')->on('delivery_rounds');

            $table->integer('status')->default(0);
            $table->integer('quantity')->default(1);
            $table->integer('weight')->unsigned();

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
