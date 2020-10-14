<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiciklSpecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bicikl_specs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ram');
            $table->string('boja');
            $table->string('viljuska');
            $table->string('zadnjiAmortizer');
            $table->string('kocnice');
            $table->string('menjacZadnji');
            $table->string('menjacPrednji');
            $table->unsignedBigInteger('proizvod_id');
            $table->foreign('proizvod_id')->references('id')->on('proizvods');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bicikl_specs');
    }
}
