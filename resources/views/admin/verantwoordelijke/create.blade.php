@extends('layouts.template')

@section('title', 'Create new verantwoordelijke')

@section('main')
    <h1>Create new verantwoordelijke</h1>
    <form action="/admin/vrijwilligers" method="post">
        @include('admin.vrijwilligers.form')
    </form>
@endsection
