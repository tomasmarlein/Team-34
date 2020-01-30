@extends('layouts.template')
@section('title', 'Vereniging aanvragen')


@section('main')
    <div>
        <h1>Samenwerken</h1>

        <p>Ben jij de verantwoordelijke van een vereniging of wil je als vrijwilliger komen helpen op evenementen van
            VZW Keizer Karel Olen vul dan het hieronder geplaatste formulier in:
    </div>

    <form action="{{url('verenigingAanvragen')}}" method="get">
        <hr class="mb-4">
        <h3>Verantwoordelijke toevoegen</h3>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="naam">Naam</label>
                <input type="text" class="form-control" name="naam" id="naam" placeholder="Naam" value="">
            </div>
            <div class="col-md-6 mb-3">
                <label for="voornaam">voornaam</label>
                <input type="text" class="form-control"  name="voornaam" id="voornaam" placeholder="Voornaam" value="">
            </div>
        </div>


        <div class="mb-3">
            <label for="email">E-Mail</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="E-mail">
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
            <div class="col-md-6 mb-3">
                <label for="rijksregisternr">Rijksregisternummer</label>
                <input type="text" class="form-control"  name="rijksregisternr" id="rijksregisternr" placeholder="rijksregisternr" value="">
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
                <input type="text" class="form-control" name="huisnummer" id="huisnummer" placeholder="huisnummer">
            </div>

            <div class="col-md-3 mb-3">
                <label for="postcode">Postcode</label>
                <input type="text" class="form-control" name="postcode" id="postcode" placeholder="postcode">
            </div>
        </div>

        <hr class="mb-4">
        <button type="submit" class="btn btn-primary btn-lg btn-block">
            Ga verder
        </button>
    </form>
@endsection

