@extends('layouts.template')

@section('title', 'Evenementen')

@section('main')
    <h1>{{$evenement->naam}}</h1>

    <div style="float: right">
        <a href="/tijdsregistratie">
            <div class="card text-black bg-light mb-3" style="max-width: 18rem;">
                <div class="card-header">Geschatte uren</div>
                <div class="card-body">
                    <h1 class="card-title" style="" id="uren">Uren hierzo</h1>

                </div>
            </div>
        </a>
    </div>


    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Naam</th>
                <th>Hoofdverantwoordelijke</th>
                <th>Startdatum</th>
                <th>Actief</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

@endsection



