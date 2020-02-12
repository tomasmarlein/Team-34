@extends('layouts.template')
@section('title', 'Vereniging aanvragen')


@section('main')
    <div>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width: 5%"></div>
        </div>
        <h1>Samenwerken</h1>

        <p>Ben jij de verantwoordelijke van een vereniging of wil je als vrijwilliger komen helpen op evenementen van
            VZW Keizer Karel Olen vul dan het hieronder geplaatste formulier in:
    </div>

    <form action="{{url('verenigingAanvragen')}}" method="get">
        <hr class="mb-4">
        <h3>Verantwoordelijke toevoegen</h3>


        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="naam">Naam *</label>
                <input oninput="checkNaam()" type="text" class="form-control is-invalid" name="naam" id="naam" placeholder="Naam" value="" required>
                <div class="invalid-feedback">
                  Naam is Verplicht
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="voornaam">voornaam *</label>
                <input oninput="checkVoornaam()" type="text" class="form-control is-invalid"  name="voornaam" id="voornaam" placeholder="Voornaam" value="" required>
                <div class="invalid-feedback">
                    Voornaam is Verplicht
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="email">E-Mail *</label>
                <input oninput="checkEmail()" type="text" class="form-control is-invalid" name="email" id="email" placeholder="E-mail" required>
                <div class="invalid-feedback">
                    E-mail is Verplicht
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="rijksregisternr">Rijksregisternummer *   <b>NIET: </b>89.05.14-168.85 <b> WEL: </b> 88051416885 </label>
                <input oninput="checkRijks()" type="text" class="form-control is-invalid"  name="rijksregisternr" id="rijksregisternr" placeholder="rijksregisternr" value="">
                <div class="invalid-feedback">
                    Rijksregisternummer is Verplicht
                </div>
            </div>
        </div>




        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="telefoon">Telefoon</label>
                <input type="text" class="form-control" name="telefoon" id="telefoon" placeholder="Telefoon" value="">
            </div>
            <div class="col-md-6 mb-3">
                <label for="geboortedatum">Geboortedatum</label>
                <input type="date" class="form-control"  name="geboortedatum" id="geboortedatum" placeholder="" value="">
            </div>

        </div>

        <hr class="mb-4">
        <button type="submit" class="btn btn-primary btn-lg btn-block">
            Ga verder
        </button>
    </form>
@endsection

@section('script_after')
<script>


    $( document ).ready(function() {
        var inp = $("input[id='rijksregisternr'] ");
        inp.bind('keyup', function(){
            this.value = this.value.replace(/[^0-9]/,'');
        });
    });




    function checkNaam() {

        var naamveld = document.getElementById("naam").value;

        if(naamveld === ""){
            $('#naam').addClass("is-invalid");

        }else {

            $('#naam').removeClass("is-invalid");
            $('#naam').addClass("is-valid");
        }
    }


    function checkVoornaam() {

        var naamveld = document.getElementById("voornaam").value;

        if(naamveld === ""){
            $('#voornaam').addClass("is-invalid");

        }else {

            $('#voornaam').removeClass("is-invalid");
            $('#voornaam').addClass("is-valid");
        }
    }




    function checkEmail() {

        var naamveld = document.getElementById("email").value;

        if(naamveld === ""){
            $('#email').addClass("is-invalid");

        }else {

            $('#email').removeClass("is-invalid");
            $('#email').addClass("is-valid");
        }
    }

    function checkRijks() {

        var naamveld = document.getElementById("rijksregisternr").value;

        if(naamveld === ""){
            $('#rijksregisternr').addClass("is-invalid");

        }else {

            $('#rijksregisternr').removeClass("is-invalid");
            $('#rijksregisternr').addClass("is-valid");
        }
    }
</script>


@endsection
