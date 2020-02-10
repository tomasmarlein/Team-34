<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taaks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('subtaak_id');
            $table->unsignedBigInteger('taakgroep_id');
            $table->dateTime('startDatum');
            $table->dateTime('eindDatum');
            $table->integer('aantalPersonen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taaks');
    }
}
