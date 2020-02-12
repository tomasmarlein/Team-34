@extends('layouts.template')
@section('title', 'Vereniging aanvragen')


@section('main')
    <div>

        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
        </div>
        <h1>Welkom {{$gebruikers->voornaam}} {{$gebruikers->naam}}</h1>
    </div>

    <form action="{{url('verenigingAanvragenNext')}}" method="get">
        <h3>Vereniging aanvragen:</h3>
        <div class="mb-3">
            <label for="naam">Naam Vereniging</label>
            <div class="input-group">
                <input oninput="checkNaam()" type="text" required class="form-control is-invalid" name="naam" id="naam" placeholder="Naam Vereniging">

                <div class="invalid-feedback">
                    Naam is Verplicht
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="rekeningnr">Rekeningnummer</label>
                <input oninput="checkRekening()" type="text" required class="form-control is-invalid"  name="rekeningnr" id="rekeningnr" placeholder="BE0000000000000000" value="">
                <div class="invalid-feedback">
                    Rekening Nummer is Verplicht
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="btwnr">BTW Nummer</label>
                <input oninput="checkBTW()" type="text" required class="form-control is-invalid"  name="btwnr" id="btwnr" placeholder="BTW" value="">
                <div class="invalid-feedback">
                    BTW Nummer is Verplicht
                </div>
            </div>
        </div>


        <div class="mb-3">
            <label for="gemeente">Gemeente</label>
            <input type="text" class="form-control" name="gemeente" id="gemeente" placeholder="Gemeente">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="straat">Straat</label>
                <input type="text" class="form-control" name="straat" id="straat" placeholder="Straatnaam" >
            </div>

            <div class="col-md-3 mb-3">
                <label for="huisnummer">Huisnummer</label>
                <input type="text" class="form-control"  name="huisnummer" id="huisnummer" placeholder="huisnummer">
            </div>

            <div class="col-md-3 mb-3">
                <label for="postcode">Postcode</label>
                <input type="text" class="form-control" name="postcode" id="postcode" placeholder="postcode">
            </div>
        </div>

        <hr class="mb-4">
        <a href="javascript:history.back()"  class="btn btn-primary btn-lg btn-block">Ga Terug</a>

        <button type="submit" class="btn btn-primary btn-lg btn-block">
            Ga Verder
        </button>
    </form>
@endsection
@section('script_after')
    <script>






        function checkNaam() {

            var naamveld = document.getElementById("naam").value;

            if(naamveld === ""){
                $('#naam').addClass("is-invalid");

            }else {

                $('#naam').removeClass("is-invalid");
                $('#naam').addClass("is-valid");
            }
        }



        function checkBTW() {

            var naamveld = document.getElementById("btwnr").value;

            if(naamveld === ""){
                $('#btwnr').addClass("is-invalid");

            }else {

                $('#btwnr').removeClass("is-invalid");
                $('#btwnr').addClass("is-valid");
            }
        }




        function checkRekening() {

            var naamveld = document.getElementById("rekeningnr").value;

            if(naamveld === ""){
                $('#rekeningnr').addClass("is-invalid");

            }else {

                $('#rekeningnr').removeClass("is-invalid");
                $('#rekeningnr').addClass("is-valid");
            }
        }
    </script>


@endsection
