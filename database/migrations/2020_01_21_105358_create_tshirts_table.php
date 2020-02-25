<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTshirtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tshirts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('maat');
            $table->string('geslacht');
            $table->integer('aantal');
            $table->unsignedBigInteger('gebruikers_id')->nullable();
            $table->unsignedBigInteger('types_id')->nullable();

            $table->foreign('gebruikers_id')->references('id')->on('gebruikers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('types_id')->references('id')->on('tshirt_types')->onDelete('cascade')->onUpdate('cascade');
        });
        // Insert roles
        DB::table('tshirts')->insert(
            [
                [
                    'id' => 1,
                    'maat' => "XL",
                    'geslacht' => 'V',
                    'aantal'=> 1,
                    'gebruikers_id'=> 34,
                    'types_id'=> 1
                ]
            ]
        );

        DB::table('tshirts')->insert(
            [
                [
                    'id' => 2,
                    'maat' => "XL",
                    'geslacht' => 'V',
                    'aantal'=> 2,
                    'gebruikers_id'=> 34,
                    'types_id'=> 2
                ]
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
        Schema::dropIfExists('tshirts');
    }
}
