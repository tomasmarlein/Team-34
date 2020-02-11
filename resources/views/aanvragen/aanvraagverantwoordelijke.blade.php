@extends('layouts.template')
@section('title', 'Vereniging aanvragen')


@section('main')
    <div>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%"></div>
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
                <label for="naam">Naam</label>
                <input type="text" class="form-control" name="naam" id="naam" placeholder="Naam" value="" required>
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

        <hr class="mb-4">
        <button type="submit" class="btn btn-primary btn-lg btn-block">
            Ga verder
        </button>
    </form>
@endsection

