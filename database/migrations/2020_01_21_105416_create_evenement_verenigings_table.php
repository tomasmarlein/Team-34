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
        Schema::create('evenements_verenigings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('evenements_id');
            $table->unsignedBigInteger('verenigings_id');


        });
        for ($i = 1; $i <= 10; $i++) {
        DB::table('evenements_verenigings')->insert(
            [
                'evenements_id'=> "1",
                'verenigings_id' => $i

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
