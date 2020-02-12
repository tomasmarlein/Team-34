<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLidVansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gebruikers_verenigings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('verenigings_id');
            $table->unsignedBigInteger('gebruikers_id');

            $table->foreign('gebruikers_id')->references('id')->on('gebruikers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('verenigings_id')->references('id')->on('verenigings')->onDelete('cascade')->onUpdate('cascade');
        });
        for ($i = 23; $i <= 32; $i++) {
            DB::table('gebruikers_verenigings')->insert(
                [
                    'verenigings_id'=> $i-22,
                    'gebruikers_id' => $i

                ]
            );
        }
        for ($i = 34; $i <= 43; $i++) {
            DB::table('gebruikers_verenigings')->insert(
                [
                    'verenigings_id'=> $i-33,
                    'gebruikers_id' => $i

                ]
            );
        }
        DB::table('gebruikers_verenigings')->insert(
            [
                'verenigings_id'=> 1,
                'gebruikers_id' => 44

            ]
        );
        DB::table('gebruikers_verenigings')->insert(
            [
                'verenigings_id'=> 3,
                'gebruikers_id' => 35

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
        Schema::dropIfExists('lid_vans');
    }
}
