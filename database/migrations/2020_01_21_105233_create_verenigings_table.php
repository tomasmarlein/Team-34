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
            $table->unsignedBigInteger('hoofdverantwoordelijke')->unique();
            $table->unsignedBigInteger('2deverantwoordelijke')->nullable();
            $table->string('rekeningnr');
            $table->string('btwnr');
            $table->string('straat');
            $table->string('huisnummer');
            $table->string('gemeente');
            $table->string('postcode');

            $table->foreign('hoofdverantwoordelijke')->references('id')->on('gebruikers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('2deverantwoordelijke')->references('id')->on('verenigings')->onDelete('cascade')->onUpdate('cascade');
        });
        // Add 40 dummy users inside a loop

//            DB::table('verenigings')->insert(
//                [
//                    'naam' => "vereniging zelfstandig",
//                ]
//            );

//            for ($i = 1; $i <= 10; $i++) {
//                DB::table('verenigings')->insert(
//                [
//                    'naam' => "vereniging $i",
//                    'rekeningnr' => "rekeningnr $i",
//                    'btwnr' => "btwnr $i",
//                    "postcode" => "2440",
//                    "straat" => "straat $i",
//                    "huisnummer" => "$i",
//                    "gemeente" => "Geel",
//
//
//
//
//                ]
//            );
//        }
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
