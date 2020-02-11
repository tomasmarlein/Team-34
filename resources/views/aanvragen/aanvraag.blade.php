@extends('layouts.template')
@section('title', 'Vereniging aanvragen')


@section('main')
    <div>

        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%"></div>
        </div>
        <h1>Welkom {{$gebruikers->voornaam}} {{$gebruikers->naam}}</h1>
    </div>

    <form action="{{url('verenigingAanvragenNext')}}" method="get">
        <h3>Vereniging aanvragen:</h3>
        <div class="mb-3">
            <label for="naam">Naam Vereniging</label>
            <div class="input-group">
                <input type="text" required class="form-control" name="naam" id="naam" placeholder="Naam Vereniging">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="rekeningnr">rekeningnr</label>
                <input type="text" required class="form-control"  name="rekeningnr" id="rekeningnr" placeholder="BE0000000000000000" value="">
            </div>
            <div class="col-md-6 mb-3">
                <label for="btwnr">BTW Nummer</label>
                <input type="text" required class="form-control"  name="btwnr" id="btwnr" placeholder="BTW" value="">
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
