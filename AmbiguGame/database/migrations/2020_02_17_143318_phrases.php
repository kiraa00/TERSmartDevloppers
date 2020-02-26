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
            $table->integer('nbrjouer')->nullable();
            $table->integer('nbrlike')->nullable();
            $table->integer('gain')->nullable();
            $table->integer('dejajouer')->nullable();
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
