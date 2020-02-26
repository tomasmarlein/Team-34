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
                    'hoofdverantwoordelijke' => "23",
                    'tweedeverantwoordelijke' => "44",
                    'actief' => false,
                    'inaanvraag' => true,
                    'contactpersoon' => 23,
                ]
            );

            for ($i = 2; $i <= 10; $i++) {
                DB::table('verenigings')->insert(
                [
                    'naam' => "Vereniging_$i",
                    'rekeningnr' => "BE68539007547034_$i",
                    'btwnr' => "BE0000.111.222",
                    "postcode" => "2440",
                    'straat' => "straat_$i",
                    'huisnummer' => "$i",
                    'gemeente' => "Geel",
                    'hoofdverantwoordelijke' => $i + 22,
                    'actief' => false,
                    'inaanvraag' => false,
                    'contactpersoon' => $i + 22,
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
        Schema::dropIfExists('verenigings');
    }
}
