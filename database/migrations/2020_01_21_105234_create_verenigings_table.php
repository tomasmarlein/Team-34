<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerenigingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verenigings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('naam');
            $table->unsignedBigInteger('hoofdverantwoordelijke');
            $table->unsignedBigInteger('tweedeverantwoordelijke')->nullable();
            $table->boolean("actief")->nullable();
            $table->string('rekeningnr');
            $table->string('btwnr')->nullable();
            $table->string('straat')->nullable();
            $table->string('huisnummer')->nullable();
            $table->string('gemeente')->nullable();
            $table->string('postcode')->nullable();
            $table->unsignedBigInteger('contactpersoon')->nullable();
            $table->boolean('inaanvraag');
            //$table->foreign('hoofdverantwoordelijke')->references('id')->on('gebruikers')->onDelete('cascade')->onUpdate('cascade');
            //$table->foreign('tweedeverantwoordelijke')->references('id')->on('verenigings')->onDelete('cascade')->onUpdate('cascade');
        });
        // Add zelfstandige vereniging en dummy verenigingen in een loop

            DB::table('verenigings')->insert(
                [
                    'naam' => "vereniging zelfstandig",
                    'rekeningnr' => "BE68539007547034",
                    'btwnr' => "BE0000.111.222",
                    "postcode" => "2440",
                    'straat' => "straat",
                    'huisnummer' => "20",
                    'gemeente' => "Geel",
                    'hoofdverantwoordelijke' => "9",
                    'tweedeverantwoordelijke' => null,
                    'actief' => false,
                    'inaanvraag' => false,
                    'contactpersoon' => 23,
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
        Schema::dropIfExists('verenigings');
    }
}
