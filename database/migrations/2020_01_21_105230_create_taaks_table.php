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


        for ($i = 1; $i <= 10; $i++) {
            DB::table('taaks')->insert(
                [
                    'subtaak_id'=> $i,
                    'taakgroep_id'=> $i,
                    'startDatum'=> now(),
                    'eindDatum'=> now(),
                    'aantalPersonen'=> $i
                ]
            );
        }
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
