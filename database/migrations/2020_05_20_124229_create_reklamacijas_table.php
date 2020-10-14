<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReklamacijasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reklamacijas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('email');
            $table->string('ime');
            $table->string('prezime');
            $table->unsignedBigInteger('id_racuna');
            $table->string('proizvodi');
            $table->text('poruka');
            $table->boolean('pregledana');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reklamacijas');
    }
}
