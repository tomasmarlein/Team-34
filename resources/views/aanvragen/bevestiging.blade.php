@extends('layouts.template')
@section('title', 'Bevestiging')


@section('main')
<style>
    .wachtwoordBox{
        border-radius: 1%;
        box-shadow: 10px 10px 5px grey;
        background-color: red;
        padding: 5%;
         margin-bottom: 5%;
        color:white;

        font-size: 15pt;

    }


    .checkFor{
        border: black;

        border-radius: 1%;
        box-shadow: 10px 10px 5px grey;
        background-color: white;
        padding: 5%;
        margin-bottom: 5%;
        font-size: 15pt;
        color: black;


    }

    .double {
        zoom: 2;
        transform: scale(2);
        -ms-transform: scale(2);
        -webkit-transform: scale(2);
        -o-transform: scale(2);
        -moz-transform: scale(2);
        transform-origin: 0 0;
        -ms-transform-origin: 0 0;
        -webkit-transform-origin: 0 0;
        -o-transform-origin: 0 0;
        -moz-transform-origin: 0 0;
        text-align: center;
    }

</style>


    <form>
        <div>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75"
                 aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
            </div>
            <h1>Bevestig je gegevens</h1>
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


            <div class="col-md-6 mb-3">
                <label for="naam"><b>Rijksregisternummer : </b></label>
                <h4>{{Session::get('rijksregisternr')}} </h4>
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

            <div class="col-md-12">
                <div class="wachtwoordBox">
                    <h2 for="naam"><b>Wachtwoord : </b></h2>
                    <p>Jouw gegenereerd wachtwoord is <b style="font-size: 25pt">{{Session::get('opmerking')}}</b> wij raden aan om dit zo snel
                        mogelijk te veranderen.</p>

                    <p>Bewaar het ergens indien je niet meteen kan inloggen.</p>
                </div>
            </div>
        </div>


        <div class="row">

            <div class="col-md-12">
                <div class="checkFor">
                   <label>Gelieve aan te vinken dat u alles begrijpt en u ergens het wachtwoord heeft bewaard.</label>
                    <div class="custom-control custom-checkbox double">
                        <input onclick="check()" type="checkbox" class="custom-control-input" id="checkBox">
                        <label class="custom-control-label" for="checkBox"></label>
                    </div>
                </div>
            </div>
        </div>

        <hr class="mb-4">
        <h4>Ziet u iets dat niet klopt? Ga dan terug naar de vorige pagina's.</h4>
        <a href="javascript:history.back()" class="btn btn-primary btn-lg btn-block">Ga Terug</a>
        <a onclick="disableButton()" href="aanvraagBevestigen" id="voltooien"  class="btn btn-primary btn-lg btn-block disabled">Voltooien</a>
    </form>
@endsection

@section('script_after')
    <script>

        function check(){
            var checkbox = document.getElementById("checkBox");
            var knop = document.getElementById("voltooien");

            if(checkbox.checked){
                $(knop).removeClass("disabled");

            }else{
                $(knop).addClass("disabled");
            }

        };

        function disableButton(){
            document.getElementById("voltooien").style.display = 'none';
           // knop.style.display = 'none';
        }



    </script>


@endsection

