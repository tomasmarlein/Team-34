<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rols', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('naam');
        });
        // Insert roles
        DB::table('rols')->insert(
            [
                [
                    'naam' => 'Admin',
                ],
                [
                    'naam' => 'Kernlid',
                ],
                [
                    'naam' => 'Verantwoodelijke',
                ],
                [
                    'naam' => 'Vrijwilliger',
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
        Schema::dropIfExists('rols');
    }
}
