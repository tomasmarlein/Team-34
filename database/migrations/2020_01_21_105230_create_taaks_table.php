<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taaks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("naam");
        });

        // Insert dummy taken
        DB::table('taaks')->insert(
            [
                [
                    'naam' => 'tappen',
                ],
                [
                    'naam' => 'security',
                ],
                [
                    'naam' => 'Opboux',
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
        Schema::dropIfExists('taaks');
    }
}
