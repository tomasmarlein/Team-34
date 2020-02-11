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
            $table->unsignedBigInteger('tshirtId');
            $table->string('type');
            $table->unsignedBigInteger('evenementId');

            $table->foreign('tshirtId')->references('id')->on('tshirts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('evenementId')->references('id')->on('evenements')->onDelete('cascade')->onUpdate('cascade');
        });

            DB::table('tshirt_types')->insert(
                [
                    'type'=> 'Crew',
                    'evenementId'=> 1,
                    'tshirtId'=> 1,
                ]
            );

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
