<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Phrases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phrases', function (Blueprint $table) {
            $table->bigIncrements('idPhrase');
            $table->string('phrase');
            $table->date('datecreation');
            $table->integer('nbrjouer');
            $table->integer('nbrlike');
            $table->integer('gain');
            $table->integer('dejajouer');
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
        //
    }
}
