<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membres', function (Blueprint $table) {
            $table->bigIncrements('idMembre');
            $table->string('pseudo');
            $table->string('nomComplet');
            $table->date('dateNaissance');
            $table->string('email');
            $table->string('motDePasse');
            $table->unsignedBigInteger('idPhrase');
            $table->foreign('idPhrase')->references('idPhrase')->on('phrases')->onDelete('cascade');
            $table->string('titre');
            $table->date('dateInscription');
            $table->integer('points');
            $table->integer('credit');
            $table->integer('nbrphrasescree');
            $table->integer('nbrlikerecu');
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
        Schema::dropIfExists('membres');
    }
}
