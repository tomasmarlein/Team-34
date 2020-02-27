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
            $table->string('naam');
            $table->string('voornaam');
            $table->string('roepnaam')->nullable();
            $table->date('geboortedatum')->nullable();
            $table->string('telefoon')->nullable();
            $table->string('opmerking')->nullable();
            $table->string('rijksregisternr');
            $table->boolean('eersteAanmelding')->nullable();
            $table->boolean('lunchpakket')->nullable();
            $table->boolean('actief')->nullable();
            $table->string('qrcode')->nullable();
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('rolId')->nullable();

            $table->foreign('rolId')->references('id')->on('rols')->onDelete('cascade')->onUpdate('cascade');
        });


//        // Add 10 dummy users inside a loop
//        for ($i = 0; $i <= 10; $i++) {
//            DB::table('gebruikers')->insert(
//                [
//                    'naam' => "Admin_$i",
//                    'voornaam' => "Gladiolen_$i",
//                    'email' => "admin_$i@mailinator.com",
//                    'password' => Hash::make("admin$i"),
//                    'geboortedatum' => now(),
//                    'telefoon' => '1813',
//                    'eersteAanmelding' => false,
//                    'lunchpakket' => False,
//                    'rolId' => 1,
//                ]);
//            }
//                 for ($i = 0; $i <= 10; $i++) {
//                     DB::table('gebruikers')->insert(
//                [
//                    'naam' => "kernlid_$i",
//                    'voornaam' => "Gladiolen_$i",
//                    'email' => "kernlid_$i@mailinator.com",
//                    'password' => Hash::make("kernlid$i"),
//                    'geboortedatum' => now(),
//                    'telefoon' => '1813',
//                    'eersteAanmelding' => false,
//                    'lunchpakket' => False,
//                    'rolId' => 2,
//                ]);
//            }
//        for ($i = 0; $i <= 10; $i++) {
//            DB::table('gebruikers')->insert(
//                [
//                    'naam' => "Verantwoordelijke_$i",
//                    'voornaam' => "Gladiolen_$i",
//                    'email' => "verantwoordelijke_$i@mailinator.com",
//                    'password' => Hash::make("verant$i"),
//                    'geboortedatum' => now(),
//                    'telefoon' => '1813',
//                    'eersteAanmelding' => false,
//                    'lunchpakket' => False,
//                    'rolId' => 3,
//                ]);
//            }
//        for ($i = 0; $i <= 10; $i++) {
//            DB::table('gebruikers')->insert(
//                [
//                    'naam' => "Vrijwilliger_$i",
//                    'voornaam' => "Gladiolen_$i",
//                    'email' => "Vrijwilliger_$i@mailinator.com",
//                    'password' => Hash::make("vrijwilliger$i"),
//                    'lunchpakket'=>true,
//                    'geboortedatum' => now(),
//                    'telefoon' => '1813',
//                    'eersteAanmelding' => false,
//                    'rolId' => 4,
//                ]);
//        }

        //Default Admins aanmaken
        DB::table('gebruikers')->insert(
            [
                'naam' => "Bellens",
                'voornaam' => "Lode",
                'email' => "lode@gladiolen.be",
                'password' => Hash::make("32s7zLxMhX8E"),
                'geboortedatum' => "20200225",
                'telefoon' => '',
                'rijksregisternr' => '20022500103',
                'eersteAanmelding' => false,
                'lunchpakket' => False,
                'rolId' => 1,
            ]);
        DB::table('gebruikers')->insert(
            [
                'naam' => "Webers",
                'voornaam' => "Ronny",
                'email' => "ronny@gladiolen.be",
                'password' => Hash::make("Wp2XSM6Y5CJk"),
                'geboortedatum' => "20200225",
                'telefoon' => '',
                'rijksregisternr' => '20022500301',
                'eersteAanmelding' => false,
                'lunchpakket' => False,
                'rolId' => 1,
            ]);
        DB::table('gebruikers')->insert(
            [
                'naam' => "admin",
                'voornaam' => "admin",
                'email' => "admin@gladiolen.be",
                'password' => Hash::make("MCfpuk3EJxStX8KSTMQ2SHxEKqnke4"),
                'geboortedatum' => "20200225",
                'telefoon' => '',
                'rijksregisternr' => '20022500596',
                'eersteAanmelding' => false,
                'lunchpakket' => False,
                'rolId' => 1,
            ]);
        DB::table('gebruikers')->insert(
            [
                'naam' => "Admin_1",
                'voornaam' => "Gladiolen",
                'email' => "admin_1@mailinator.com",
                'password' => Hash::make("admin1"),
                'geboortedatum' => now(),
                'telefoon' => '',
                'rijksregisternr' => '20022501190',
                'eersteAanmelding' => false,
                'lunchpakket' => False,
                'rolId' => 1,
            ]);

        DB::table('gebruikers')->insert(
            [
                'naam' => "Gielis",
                'voornaam' => "Arno",
                'email' => "r0714654@student.thomasmore.be",
                'password' => Hash::make("admin123"),
                'geboortedatum' => "19991227",
                'rijksregisternr' => '99122730380',
                'eersteAanmelding' => false,
                'lunchpakket' => False,
                'rolId' => 1,
            ]);

        //Default kernleden aanmaken
        DB::table('gebruikers')->insert(
            [
                'naam' => "Vermeersch",
                'voornaam' => "Nina",
                'email' => "nina@gladiolen.be",
                'password' => Hash::make("32s7zLxMhX8E"),
                'geboortedatum' => "19800212",
                'telefoon' => '0251621074',
                'rijksregisternr' => '80021200271',
                'eersteAanmelding' => false,
                'lunchpakket' => False,
                'rolId' => 2,
            ]);
        DB::table('gebruikers')->insert(
            [
                'naam' => "Dumont",
                'voornaam' => "Lisa",
                'email' => "lisa@gladiolen.be",
                'password' => Hash::make("p3Xd7hysA63b"),
                'geboortedatum' => "19700501",
                'telefoon' => '',
                'rijksregisternr' => '70050100218',
                'eersteAanmelding' => false,
                'lunchpakket' => False,
                'rolId' => 2,
            ]);
        DB::table('gebruikers')->insert(
            [
                'naam' => "De Groote",
                'voornaam' => "Mathéo",
                'email' => "matheo@gladiolen.be",
                'password' => Hash::make("Jnv4VSFs6ce2"),
                'geboortedatum' => "20011230",
                'telefoon' => '060801365',
                'rijksregisternr' => '01123000109',
                'eersteAanmelding' => false,
                'lunchpakket' => False,
                'rolId' => 2,
            ]);

        //Default verantwoordelijken aanmaken
        DB::table('gebruikers')->insert(
            [
                'naam' => "De Greef",
                'voornaam' => "Malak",
                'email' => "malak@gladiolen.be",
                'password' => Hash::make("MRcyXgTE4J9p"),
                'geboortedatum' => "20020505",
                'telefoon' => '0776397452',
                'rijksregisternr' => '02050500152',
                'eersteAanmelding' => false,
                'lunchpakket' => False,
                'rolId' => 3,
            ]);
        DB::table('gebruikers')->insert(
            [
                'naam' => "Roland",
                'voornaam' => "Jarne",
                'email' => "jarne.roland@hotmail.com",
                'password' => Hash::make("j9xSmU42xdvX"),
                'geboortedatum' => "19851006",
                'telefoon' => '0398159638',
                'rijksregisternr' => '85100600125',
                'eersteAanmelding' => false,
                'lunchpakket' => False,
                'rolId' => 3,
            ]);
        DB::table('gebruikers')->insert(
            [
                'naam' => "Martens",
                'voornaam' => "Lola",
                'email' => "lola.martens@mail.com",
                'password' => Hash::make("Nn8tnXUxfCZT"),
                'geboortedatum' => "19991224",
                'telefoon' => '0569462124',
                'rijksregisternr' => '99122400283',
                'eersteAanmelding' => false,
                'lunchpakket' => False,
                'rolId' => 3,
            ]);

//        //Default vrijwilligers aanmaken
//        DB::table('gebruikers')->insert(
//            [
//                'naam' => "Lenaerts",
//                'voornaam' => "Mats",
//                'email' => "mats.lenaerts@thomasmore.be",
//                'password' => Hash::make("F6V4kyhzG2x9"),
//                'geboortedatum' => "19560603",
//                'telefoon' => '0776397452',
//                'rijksregisternr' => '063205316',
//                'eersteAanmelding' => false,
//                'lunchpakket' => False,
//                'rolId' => 4,
//            ],
//            [
//                'naam' => "Aaron",
//                'voornaam' => "Lambert",
//                'email' => "aaron.lambert@outlook.com",
//                'password' => Hash::make("j9xSmU42xdvX"),
//                'geboortedatum' => "20030909",
//                'telefoon' => '0677824314',
//                'rijksregisternr' => '03090900178',
//                'eersteAanmelding' => false,
//                'lunchpakket' => False,
//                'rolId' => 4,
//            ],
//            [
//                'naam' => "Dubois",
//                'voornaam' => "Jeanne",
//                'email' => "jeanne.dubois@microsoft.com",
//                'password' => Hash::make("WHqe48NPb44A"),
//                'geboortedatum' => "19740718",
//                'telefoon' => '089418930',
//                'rijksregisternr' => '74071800291',
//                'eersteAanmelding' => false,
//                'lunchpakket' => False,
//                'rolId' => 4,
//            ]);
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
