<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContenirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contenirs', function (Blueprint $table) {
            $table->unsignedBigInteger('idPhrase');
            $table->unsignedBigInteger('idMot');
            $table->primary(['idPhrase', 'idMot']);
            $table->foreign('idMot')->references('idMot')->on('motsambigues')->onDelete('cascade');
            $table->foreign('idPhrase')->references('idPhrase')->on('phrases')->onDelete('cascade');
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
        Schema::dropIfExists('contenirs');
    }
}
