<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTshirtTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tshirt_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('tshirtId')->nullable();
            $table->unsignedBigInteger('evenementId')->nullable();

            $table->foreign('tshirtId')->references('id')->on('tshirt')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('evenementId')->references('id')->on('evenementen')->onDelete('cascade')->onUpdate('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tshirt_types');
    }
}
