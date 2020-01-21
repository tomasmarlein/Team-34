<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();


                $table->string('naam');
                $table->string('voornaam');
                $table->string('roepnaam');
                $table->string('straat');
                $table->string('huisnummer');
                $table->dateTime('geboortedatum');
                $table->string('telefoon');
                $table->boolean('2detshirt');
                $table->string('opmerking');
                $table->string('rijksregisternr');
                $table->string('postcode');
                $table->boolean('eersteAanmelding');
                $table->boolean('lunchpakket');
                $table->boolean('actief');
                $table->string('qrcode');
                $table->string('foto');
                $table->unsignedBigInteger('tshirtId');
                $table->unsignedBigInteger('rolId');

                $table->foreign('tshirtId')->references('id')->on('tshirts')->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('rolId')->references('id')->on('rols')->onDelete('cascade')->onUpdate('cascade');



        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
