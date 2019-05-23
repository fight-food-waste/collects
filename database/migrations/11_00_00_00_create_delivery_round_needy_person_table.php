<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryRoundNeedyPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_round_needy_person', function (Blueprint $table) {
            $table->unsignedBigInteger('delivery_round_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('delivery_round_id')->references('id')->on('delivery_rounds')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('delivery_round_needy_person');
    }
}
