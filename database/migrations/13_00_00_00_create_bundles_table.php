<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBundlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bundles', function (Blueprint $table) {
            $table->bigIncrements('id')->primary();
            $table->timestamp('submitted_at');
            $table->timestamp('validated_at')->nullable();

            $table->unsignedBigInteger('bundle_status_id')->nullable();
            $table->foreign('bundle_status_id')->references('id')->on('bundle_statuses');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('collection_round_id')->nullable();
            $table->foreign('collection_round_id')->references('id')->on('collection_rounds');

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
        Schema::dropIfExists('bundles');
    }
}
