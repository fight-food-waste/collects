<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTrucksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trucks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->integer('capacity')->default(100);

            $table->unsignedBigInteger('warehouse_id');
            $table->foreign('warehouse_id')->references('id')->on('warehouses');

            $table->unsignedBigInteger('collection_round_id')->nullable();
            $table->foreign('collection_round_id')->references('id')->on('collection_rounds');

            $table->unsignedBigInteger('delivery_round_id')->nullable();
            $table->foreign('delivery_round_id')->references('id')->on('delivery_rounds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
