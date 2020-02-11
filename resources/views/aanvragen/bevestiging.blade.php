@extends('layouts.template')
@section('title', 'Bevestiging')


@section('main')



        <form>
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
            </div>
            <hr class="mb-4">

            <h3><b>Vereniging :</b></h3>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="naam"><b>Vereniging : </b></label>
                    <h4>{{Session::get('verenigingssnaam')}}</h4>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="naam"><b>Rekening Nummer : </b></label>
                    <h4>{{Session::get('verenigingsrekeningnr')}}</h4>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <label for="naam"><b>Adres : </b></label>
                    <h4>{{Session::get('verenigingsstraat')}} {{Session::get('verenigingshuisnummer')}}</h4>
                    <h4>{{Session::get('verenigingspostcode')}} {{Session::get('verenigingsgemeente')}}</h4>
                </div>
            </div>



            <hr class="mb-4">
            <h3><b>U als Verantwoordelijke :</b></h3>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="naam"><b>Naam & Voornaam : </b></label>
                    <h4>{{Session::get('gebruikersnaam')}} {{Session::get('gebruikersvoornaam')}}</h4>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="naam"><b>Email : </b></label>
                    <h4>{{Session::get('gebruikersemail')}} </h4>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="naam"><b>Geboortedatum : </b></label>
                    <h4>{{Session::get('gebruikersgeboortedatum')}}</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="naam"><b>Rijksregisternummer : </b></label>
                    <h4>{{Session::get('rijksregisternr')}} </h4>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="naam"><b>Wachtwoord : </b></label>
                    <p>Jouw standaard wachtwoord is <b>Azerty123</b>, wij raden aan om dit zo snel mogelijk te veranderen.</p>
                </div>
            </div>

            <hr class="mb-4">
            <h4>Ziet u iets dat niet klopt? Ga dan terug naar de vorige pagina's.</h4>
            <a href="javascript:history.back()"  class="btn btn-primary btn-lg btn-block">Ga Terug</a>
            <a href="aanvraagBevestigen" class="btn btn-primary btn-lg btn-block">Voltooien</a>
        </form>
@endsection
