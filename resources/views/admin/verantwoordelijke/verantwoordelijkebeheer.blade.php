@extends('layouts.template')
@section('title', 'Verantwoordelijkebeheer')


@section('main')
    <div>
        <h1>Verantwoordelijkebeheer</h1>

        <form method="get" action="#" id="searchForm">
            <div class="row">
                <div class="col-sm-6 mb-2">
                    <p>Filter Naam of Email</p>
                    <input type="text" class="form-control" name="artist" id="artist"
                           value="" placeholder="Filter Name Or Email">
                </div>
                <div class="col-sm-4 mb-2">
                    <p>sorteet</p>
                    <select class="form-control" name="#" id="#">
                        <option>naam (A=>Z)</option>
                    </select>
                </div>
                <div class="col-sm-2 mb-2">
                    <p>Nieuwe vereniging</p>
                    <button href="#!" class="btn btn-outline-success" id="btn-create">Nieuwe vereniging</button>
                </div>
            </div>
        </form>

    </div>
@endsection
@section('script_after')
    <script>

    </script>
    @endsection
