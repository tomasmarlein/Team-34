@extends('layouts.template')

@section('title', 'Edit Tijdsregistratie')

@section('main')
    <h1>Edit tijdsregistratie voor: {{ $tijdsregiestratie->naam }}</h1>
    <form action="admin/tijdsregistratie/{{ $tijdsregiestratie->id }}" method="post">
        @method('put')
        @csrf
        <div class="form-group">
            <label for="name">naam</label>
            <input type="text" name="name" id="naam"
                   class="form-control @error('naam') is-invalid @enderror"
                   placeholder="Name"
                   minlength="3"
                   required
                   value="{{ old('name', $tijdsregiestratie->naam) }}">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>
        <label for="name">naam</label>
        <input type="text" name="name" id="naam"
               class="form-control @error('naam') is-invalid @enderror"
               placeholder="Name"
               minlength="3"
               required
               value="{{ old('name', $tijdsregiestratie->naam) }}">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        </div>
        <button type="submit" class="btn btn-success">Save genre</button>
    </form>
@endsection
