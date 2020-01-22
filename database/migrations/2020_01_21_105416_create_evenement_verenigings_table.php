<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvenementVerenigingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evenement_verenigings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('evenementId');
            $table->unsignedBigInteger('verenigingId');

            $table->foreign('evenementId')->references('id')->on('evenements')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('verenigingId')->references('id')->on('verenigings')->onDelete('cascade')->onUpdate('cascade');
        });
        for ($i = 0; $i <= 10; $i++) {
        DB::table('evenement_verenigings')->insert(
            [
                'evenementId'=> "1",
                'verenigingId' => $i

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
        Schema::dropIfExists('evenement_verenigings');
    }
}
