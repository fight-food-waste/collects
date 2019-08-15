<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('api_token', 80)->unique()->nullable()->default(null);
            $table->string('application_filename')->nullable();
            $table->string('store_ownership_proof')->nullable();
            $table->integer('status')->default(0);
            $table->string('store_name')->nullable();

            $table->bigInteger('address_id')->unsigned()->nullable();
            $table->foreign('address_id')->references('id')->on('addresses');

            $table->bigInteger('agency_id')->unsigned()->nullable();
            $table->foreign('agency_id')->references('id')->on('agencies');

            $table->string('type');
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
        Schema::dropIfExists('users');
    }
}
