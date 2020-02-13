@extends('layouts.template')
@section('title', '')


@section('main')

    <form>
        <h1>Voltooid</h1>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
        </div>
        <hr class="mb-4">


        <div class="row">
            <div class="col-md-12">
                <h3>Vereniging : <b>{{Session::get('verenigingssnaam')}}</b></h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h3>Verantwoordelijke : <b>  {{Session::get('gebruikersnaam')}} {{Session::get('gebruikersvoornaam')}}</b></h3>
            </div>
        </div>

        <hr class="mb-4">
        <h4>Bedankt voor uw aanmelding om samen te werken.</h4>
        <h4>Uw account is gemaakt & uw vereniging is aangevraagd.</h4>
        <h4>Vanaf het moment dat uw vereniging is goedgekeurd zal u kunnen inloggen als verantwoordelijke.</h4>
        <a href="aanvraagVoltooid" class="btn btn-primary btn-lg btn-block">Naar Home</a>
    </form>
@endsection
