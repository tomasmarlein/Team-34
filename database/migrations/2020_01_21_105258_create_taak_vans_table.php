<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaakVansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taaks_verenigings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('verenigings_id');
            $table->unsignedBigInteger('taaks_id');

            $table->foreign('verenigings_id')->references('id')->on('verenigings')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('taaks_id')->references('id')->on('taaks')->onDelete('cascade')->onUpdate('cascade');
        });

        for ($i = 1; $i <= 10; $i++) {
            DB::table('taaks_verenigings')->insert(
                [
                    'verenigings_id'=> $i,
                    'taaks_id' => 1
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
        Schema::dropIfExists('taak_vans');
    }
}
