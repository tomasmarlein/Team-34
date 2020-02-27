@extends('layouts.template')

@section('title', 'Evenementen')

@section('main')
    <h1>{{$evenement->naam}}</h1>



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



