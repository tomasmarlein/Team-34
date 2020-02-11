@extends('layouts.template')
@section('title', 'Bevestiging')


@section('main')



        <form>
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%"></div>
            </div>

            <h2>Bevestiging</h2>
            <hr class="mb-4">

            <h3>Vereniging</h3>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="naam">Vereniging:</label>
                    <h4>{{Session::get('verenigingssnaam')}}</h4>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="naam">Rekening Nummer:</label>
                    <h4>{{Session::get('verenigingsrekeningnr')}}</h4>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <label for="naam">Adres:</label>
                    <h4>{{Session::get('verenigingsstraat')}} {{Session::get('verenigingshuisnummer')}}</h4>
                    <h4>{{Session::get('verenigingspostcode')}} {{Session::get('verenigingsgemeente')}}</h4>
                </div>
            </div>



            <hr class="mb-4">
            <h3>Verantwoordelijke</h3>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="naam">Naam & Voornaam:</label>
                    <h4>{{Session::get('gebruikersnaam')}} {{Session::get('gebruikersvoornaam')}}</h4>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="naam">Email:</label>
                    <h4>{{Session::get('gebruikersemail')}} </h4>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="naam">Geboortedatum:</label>
                    <h4>{{Session::get('gebruikersgeboortedatum')}}</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="naam">RijksregisterNummer:</label>
                    <h4>{{Session::get('rijksregisternr')}} </h4>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="naam">Wachtwoord:</label>
                    <p>Jouw standaard wachtwoord is <b>Azerty123</b>, wij raden aan om dit zo snel mogelijk te veranderen.</p>
                </div>
            </div>

            <hr class="mb-4">
            <a href="javascript:history.back()"  class="btn btn-primary btn-lg btn-block">Back</a>
            <a href="aanvraagBevestigen" class="btn btn-primary btn-lg btn-block">Voltooien</a>
        </form>
@endsection
