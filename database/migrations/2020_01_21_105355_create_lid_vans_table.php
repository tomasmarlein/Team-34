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
            $table->unsignedBigInteger('verenigings_id')->unsigned();
            $table->unsignedBigInteger('gebruikers_id')->unsigned();


        });


        DB::table('gebruikers_verenigings')->insert(
            [
                'verenigings_id'=> 1,
                'gebruikers_id' => 9

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
