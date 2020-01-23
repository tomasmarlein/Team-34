@extends('layouts.template')

@section('title', 'Create new vrijwilliger')

@section('main')
    <h1>Create new vrijwilliger</h1>
    <form action="/admin/vrijwilligers" method="post">
        @include('admin.vrijwilligers.form')
    </form>
@endsection
