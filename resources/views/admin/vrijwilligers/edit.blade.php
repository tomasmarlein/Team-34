@extends('layouts.template')

@section('title', 'Edit vrijwilliger')

@section('main')
    <h1>Edit vrijwilliger: {{ $gebruikers->name }}</h1>
    <form action="/admin/vrijwilligers/{{ $gebruikers->id }}" method="post" accept-charset="UTF-8">
        @method('put')
        @include('admin.admin.vrijwilligers.form')
    </form>
@endsection
