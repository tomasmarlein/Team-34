@extends('layouts.template')

@section('title', 'Edit Tijdsregistratie')

@section('main')
    <h1>Edit tijdsregistratie voor: {{ $tijdsregiestratie->naam }}</h1>
    <form action="admin/tijdsregistratie/{{ $tijdsregiestratie->id }}" method="post">
        <button type="submit" class="btn btn-success">Update tijdsregistratie</button>
        <a href="#!" class="btn" id="back">
            <i class="fas fa-undo mr-1"></i>ga terug
        </a>

@endsection
@section('script_after')
    <script>
        // Go back to the previous page
        $('#back').click(function () {
            window.history.back();
        });
    </script>
@endsection
