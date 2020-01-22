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
                $table->string('roepnaam')->nullable();
                $table->string('straat');
                $table->string('huisnummer');
                $table->dateTime('geboortedatum');
                $table->string('telefoon');
                $table->boolean('2detshirt');
                $table->string('opmerking')->nullable();
                $table->string('rijksregisternr')->nullable();
                $table->string('postcode');
                $table->boolean('eersteAanmelding');
                $table->boolean('lunchpakket');
                $table->boolean('actief')->nullable();
                $table->string('qrcode')->nullable();
                $table->string('foto')->nullable();
                $table->unsignedBigInteger('tshirtId');
                $table->unsignedBigInteger('rolId');

                $table->foreign('tshirtId')->references('id')->on('tshirts')->onDelete('cascade')->onUpdate('cascade');
                $table->foreign('rolId')->references('id')->on('rols')->onDelete('cascade')->onUpdate('cascade');



        });
        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert(
                [
                    "name" => "verantwoodelijke $i"
                    "voornaam" => "naam VW $i"
                    "email" => "VW_user_$i@test.com"
                    'password' => Hash::make("user$i"),


                ]
            );

        // Insert some users
        DB::table('users')->insert(
            [
                [
                    'name' => 'Luka Kolb',
                    'naam' => 'Kolb',
                    'voornaam' =>'Luka',
                    'email' => 'luka.kolb@test.com',
                    'rollid' => 1,
                    'password' => Hash::make('admin1234'),
                ],
                [
                    'name' => 'John Doe',
                    'naam' => 'Doe',
                    'voornaam' =>'John',
                    'email' => 'John.Doe@test.com',
                    'rollid' => 2,
                    'password' => Hash::make('user1234'),
                ],

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
        Schema::dropIfExists('users');
    }
}
