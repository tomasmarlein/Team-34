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
            $table->date('startdatum');
            $table->date('einddatum');
            $table->string('naam');
            $table->boolean('actief');
        });
        DB::table('evenements')->insert(
            [
                'startdatum'=> "20200527",
                'einddatum' => "20200531",
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
