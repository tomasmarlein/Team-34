@extends('layouts.template')
@section('title', 'Vereniging aanvragen')


@section('main')
    <div>
        <h1>Samenwerken</h1>

        <p>Ben jij de verantwoordelijke van een vereniging of wil je als vrijwilliger komen helpen op evenementen van
            VZW Keizer Karel Olen vul dan het hieronder geplaatste formulier in:
    </div>





    <h3>Vereniging aanvragen:</h3>
    <div class="mb-3">
        <label for="verenigingnaam">Naam Vereniging</label>
        <div class="input-group">
            <input type="text" class="form-control" id="verenigingnaam" placeholder="Naam Vereniging">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="rekeningnr">RekeningNummer</label>
            <input type="text" class="form-control" id="rekeningnr" placeholder="BE 0000 0000 0000 0000" value="">
        </div>
        <div class="col-md-6 mb-3">
            <label for="btwnr">BTW Nummer</label>
            <input type="text" class="form-control" id="btwnr" placeholder="BTW" value="">
        </div>
    </div>


    <div class="mb-3">
        <label for="gemeentevereniging">Gemeente</label>
        <input type="text" class="form-control" id="gemeentevereniging" placeholder="Gemeente">
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="straatvereniging">Straat</label>
            <input type="text" class="form-control" id="straatvereniging" placeholder="Straatnaam" >
        </div>

        <div class="col-md-3 mb-3">
            <label for="huisnummervereniging">Huisnummer</label>
            <input type="text" class="form-control" id="huisnummervereniging" placeholder="huisnummer">
        </div>

        <div class="col-md-3 mb-3">
            <label for="postcodevereniging">Postcode</label>
            <input type="text" class="form-control" id="postcodevereniging" placeholder="postcode">
        </div>
    </div>




    <hr class="mb-4">
   <h3>Verantwoordelijke toevoegen</h3>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="naam">Naam</label>
            <input type="text" class="form-control" id="naam" placeholder="Naam" value="">
        </div>
        <div class="col-md-6 mb-3">
            <label for="voornaam">voornaam</label>
            <input type="text" class="form-control" id="voornaam" placeholder="Voornaam" value="">
        </div>
    </div>


    <div class="mb-3">
        <label for="email">E-Mail</label>
        <input type="text" class="form-control" id="email" placeholder="E-mail">
    </div>



    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="telefoon">Telefoon</label>
            <input type="text" class="form-control" id="telefoon" placeholder="Telefoon" value="">
        </div>
        <div class="col-md-6 mb-3">
            <label for="geboortedatum">Geboortedatum</label>
            <input type="date" class="form-control" id="geboortedatum" placeholder="" value="">
        </div>
        <div class="col-md-6 mb-3">
            <label for="rijksregisternr">Rijksregisternummer</label>
            <input type="text" class="form-control" id="rijksregisternr" placeholder="rijksregisternr" value="">
        </div>
    </div>


    <div class="mb-3">
        <label for="gemeente">Gemeente</label>
        <input type="text" class="form-control" id="gemeente" placeholder="Gemeente">
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="straat">Straat</label>
            <input type="text" class="form-control" id="straat" placeholder="Straatnaam" >
        </div>

        <div class="col-md-3 mb-3">
            <label for="huisnummer">Huisnummer</label>
            <input type="text" class="form-control" id="huisnummer" placeholder="huisnummer">
        </div>

        <div class="col-md-3 mb-3">
            <label for="postcode">Postcode</label>
            <input type="text" class="form-control" id="postcode" placeholder="postcode">
        </div>
    </div>

    <hr class="mb-4">
    <button class="btn btn-primary btn-lg btn-block" type="submit">Aanvragen</button>

@endsection
