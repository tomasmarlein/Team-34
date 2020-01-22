<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvenementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evenements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('startdatum');
            $table->dateTime('einddatum');
            $table->string('naam');
            $table->boolean('actief');
        });
        DB::table('evenement_verenigings')->insert(
            [
                'startdatum'=> "22-01-2020 00:00:00",
                'einddatum' => "22-02-2020 00:00:00",
                'naam' => "Gladiolen",
                'actief' => true

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
        Schema::dropIfExists('evenements');
    }
}
