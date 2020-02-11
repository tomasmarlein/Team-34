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
            $table->string('email');
            $table->string('password')->nullable();
            $table->string('naam')->nullable();
            $table->string('voornaam')->nullable();
            $table->string('roepnaam')->nullable();

            $table->date('geboortedatum')->nullable();
            $table->string('telefoon')->nullable();

            $table->string('opmerking')->nullable();
            $table->string('rijksregisternr')->nullable();

            $table->boolean('eersteAanmelding')->nullable();
            $table->boolean('lunchpakket')->nullable();
            $table->boolean('actief')->nullable();
            $table->string('qrcode')->nullable();
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('rolId')->nullable();

            $table->foreign('rolId')->references('id')->on('rols')->onDelete('cascade')->onUpdate('cascade');
        });


        // Add 10 dummy users inside a loop
        for ($i = 0; $i <= 10; $i++) {
            DB::table('gebruikers')->insert(
                [
                    'naam' => "Admin_$i",
                    'voornaam' => "Gladiolen_$i",
                    'email' => "admin_$i@mailinator.com",
                    'password' => Hash::make("admin$i"),
                    'straat' => "Straat_$i",
                    'huisnummer' => "$i + $i",
                    'geboortedatum' => now(),
                    'telefoon' => '1813',
                    'tweedetshirt' => False,
                    'postcode' => '2440',
                    'eersteAanmelding' => false,
                    'lunchpakket' => False,
                    'tshirtId'=> 1,
                    'rolId' => 1,
                ]);
            }
                 for ($i = 0; $i <= 10; $i++) {
                     DB::table('gebruikers')->insert(
                [
                    'naam' => "kernlid_$i",
                    'voornaam' => "Gladiolen_$i",
                    'email' => "kernlid_$i@mailinator.com",
                    'password' => Hash::make("kernlid$i"),
                    'straat' => "Straat_$i",
                    'huisnummer' => "$i + $i",
                    'geboortedatum' => now(),
                    'telefoon' => '1813',
                    'tweedetshirt' => False,
                    'postcode' => '2440',
                    'eersteAanmelding' => false,
                    'lunchpakket' => False,
                    'tshirtId'=> 1,
                    'rolId' => 2,
                ]);
            }
        for ($i = 0; $i <= 10; $i++) {
            DB::table('gebruikers')->insert(
                [
                    'naam' => "Verantwoordelijke_$i",
                    'voornaam' => "Gladiolen_$i",
                    'email' => "verantwoordelijke_$i@mailinator.com",
                    'password' => Hash::make("verant$i"),
                    'straat' => "Straat_$i",
                    'huisnummer' => "$i + $i",
                    'geboortedatum' => now(),
                    'telefoon' => '1813',
                    'tweedetshirt' => False,
                    'postcode' => '2440',
                    'eersteAanmelding' => false,
                    'lunchpakket' => False,
                    'tshirtId'=> 1,
                    'rolId' => 3,
                ]);
            }
        for ($i = 0; $i <= 10; $i++) {
            DB::table('gebruikers')->insert(
                [
                    'naam' => "Vrijwilliger_$i",
                    'voornaam' => "Gladiolen_$i",
                    'email' => "Vrijwilliger_$i@mailinator.com",
                    'password' => Hash::make("vrijwilliger$i"),
                    'straat' => "Straat_$i",
                    'huisnummer' => "$i + $i",
                    'geboortedatum' => now(),
                    'telefoon' => '1813',
                    'tweedetshirt' => False,
                    'postcode' => '2440',
                    'eersteAanmelding' => false,
                    'lunchpakket' => False,
                    'tshirtId'=> 1,
                    'rolId' => 4,
                ]);
        }

        DB::table('gebruikers')->insert(
            [
                'naam' => "Marlein",
                'voornaam' => "Tomas",
                'email' => "r0676862@student.thomasmore.be",
                'password' => Hash::make("admin123"),
                'straat' => "Bosbessenstraat",
                'huisnummer' => "28",
                'geboortedatum' => "19970226",
                'telefoon' => '0493529625',
                'tweedetshirt' => False,
                'postcode' => '2400',
                'eersteAanmelding' => false,
                'lunchpakket' => False,
                'tshirtId'=> 1,
                'rolId' => 1,
            ]);
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
