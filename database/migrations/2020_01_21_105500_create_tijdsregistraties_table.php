<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTijdsregistratiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tijdsregistraties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('checkIn')->nullable();
            $table->dateTime('checkUit')->nullable();
            $table->dateTime('manCheckIn')->nullable();
            $table->dateTime('manCheckUit')->nullable();
            $table->dateTime('adminCheckIn')->nullable();
            $table->dateTime('adminCheckUit')->nullable();
            $table->unsignedBigInteger('gebruikers_id');
            $table->unsignedBigInteger('evenements_id');
            $table->unsignedBigInteger('verenigings_id');

            $table->foreign('gebruikers_id')->references('id')->on('gebruikers')->onDelete('cascade')->onUpdate('cascade');
        });

        for ($i = 1; $i <= 10; $i++) {

            DB::table('tijdsregistraties')->insert(
                [
                    'checkIn'=> now(),
                    'checkUit'=> now()->addHour(),
                    'gebruikers_id' => $i+32,
                    'evenements_id' => 1,
                    'verenigings_id' => $i,
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
        Schema::dropIfExists('tijdsregistraties');
    }
}
