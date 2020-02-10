@extends('layouts.template')
@section('title', 'Bevestiging')


@section('main')
    <form action="" method="get">
        <h3>Bevestiging</h3>
        <div class="mb-3">
            <label for="naam">Vereniging</label>
            <div class="input-group">
                <p>{{$verenigings->id}}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="rekeningnr">Gebruiker id</label>
                <p>{{$gebruikers->id}}</p>
            </div>
        </div>

        <hr class="mb-4">
        <button type="submit" class="btn btn-primary btn-lg btn-block">
            <a href="" class="btn btn-primary btn-lg btn-block">Bevestig</a>
        </button>


    </form>
@endsection
