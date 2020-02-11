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
            $table->unsignedBigInteger('tshirts_id');
            $table->string('type');
            $table->unsignedBigInteger('evenements_id');

            $table->foreign('tshirts_id')->references('id')->on('tshirts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('evenements_id')->references('id')->on('evenements')->onDelete('cascade')->onUpdate('cascade');
        });

            DB::table('tshirt_types')->insert(
                [
                    'type'=> 'Crew',
                    'evenements_id'=> 1,
                    'tshirts_id'=> 1,
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
