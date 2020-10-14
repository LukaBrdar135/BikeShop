<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProizvodUKorpisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proizvod_u_korpis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('kolicina');
            $table->unsignedBigInteger('proizvod_id');
            $table->foreign('proizvod_id')->references('id')->on('proizvods');
            $table->unsignedBigInteger('korpa_id');
            $table->foreign('korpa_id')->references('id')->on('korpas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proizvod_u_korpis');
    }
}
