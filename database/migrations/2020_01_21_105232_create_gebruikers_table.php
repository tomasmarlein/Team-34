<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGebruikersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gebruikers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('emailadres');
            $table->string('wachtwoord');
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


        // Add 10 dummy users inside a loop
        for ($i = 0; $i <= 10; $i++) {
            DB::table('gebruikers')->insert(
                [
                    'naam' => "Admin_$i",
                    'voornaam' => "Gladiolen_$i",
                    'emailadres' => "itf_user_$i@mailinator.com",
                    'wachtwoord' => Hash::make("user$i"),
                    'straat' => "Straat_$i",
                    'huisnummer' => "$i + $i",
                    'geboortedatum' => now(),
                    'telefoon' => '1813',
                    '2detshirt' => False,
                    'postcode' => '2440',
                    'eersteAanmelding' => false,
                    'lunchpakket' => False,
                    'tshirtId'=> 1,
                    'rolId' => 1,
                ],
                [
                    'naam' => "kernlid_$i",
                    'voornaam' => "Gladiolen_$i",
                    'emailadres' => "itf_user_$i@mailinator.com",
                    'wachtwoord' => Hash::make("user$i"),
                    'straat' => "Straat_$i",
                    'huisnummer' => "$i + $i",
                    'geboortedatum' => now(),
                    'telefoon' => '1813',
                    '2detshirt' => False,
                    'postcode' => '2440',
                    'eersteAanmelding' => false,
                    'lunchpakket' => False,
                    'tshirtId'=> 1,
                    'rolId' => 2,
                ],
                [
                    'naam' => "Verantwoordelijke_$i",
                    'voornaam' => "Gladiolen_$i",
                    'emailadres' => "itf_user_$i@mailinator.com",
                    'wachtwoord' => Hash::make("user$i"),
                    'straat' => "Straat_$i",
                    'huisnummer' => "$i + $i",
                    'geboortedatum' => now(),
                    'telefoon' => '1813',
                    '2detshirt' => False,
                    'postcode' => '2440',
                    'eersteAanmelding' => false,
                    'lunchpakket' => False,
                    'tshirtId'=> 1,
                    'rolId' => 3,
                ],
                [
                    'naam' => "Vrijwilliger_$i",
                    'voornaam' => "Gladiolen_$i",
                    'emailadres' => "Vrijwilliger_$i@mailinator.com",
                    'wachtwoord' => Hash::make("user$i"),
                    'straat' => "Straat_$i",
                    'huisnummer' => "$i + $i",
                    'geboortedatum' => now(),
                    'telefoon' => '1813',
                    '2detshirt' => False,
                    'postcode' => '2440',
                    'eersteAanmelding' => false,
                    'lunchpakket' => False,
                    'tshirtId'=> 1,
                    'rolId' => 4,
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
        Schema::dropIfExists('gebruikers');
    }
}
