<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Gloses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::create('gloses', function (Blueprint $table) {
            $table->bigIncrements('idGloses');
            $table->string('gloses');
            $table->string('pseudoCreateur');
            $table->unsignedBigInteger('idmembre');
            $table->foreign('idMembre')->references('idMembre')->on('membres')->onDelete('cascade');
            $table->integer('nbrchoisi');
            $table->unsignedBigInteger('idMot');
            $table->foreign('idMot')->references('idMot')->on('motsambigues')->onDelete('cascade');
            $table->timestamps();
        });    }

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
