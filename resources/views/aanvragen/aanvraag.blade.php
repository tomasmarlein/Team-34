@extends('layouts.template')
@section('title', 'Vereniging aanvragen')


@section('main')
    <div>
        <h1>hallo verantwoordelijke "naam"</h1>

        <p>Vraag nu hieronder je vereniging aan:</p>
    </div>

    <form id="form-aanvragen" method="post">
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
        <a href="verenigingAanvragen" class="btn btn-primary btn-lg btn-block">
            Voltooien
        </a>
    </form>
@endsection
