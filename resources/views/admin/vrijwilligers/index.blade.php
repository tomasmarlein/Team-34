@extends('layouts.template')

@section('title', 'Vrijwilligers')

@section('main')
    <h1>Vrijwilligers</h1>
    <p>
        <a href="/admin/vrijwilliger/create" class="btn btn-outline-success">
            <i class="fas fa-plus-circle mr-1"></i>Maak nieuwe vrijwilliger
        </a>
    </p>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Naam</th>
                <th>Voornaam</th>
                <th>Email</th>
                <th>Adres</th>
                <th>Telefoon</th>
                <th>Geboortedatum</th>
                <th>Rijksrigisternr</th>
                <th>Tshirt</th>
                <th>Lunchpakket</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $vrijwilliger)
                <tr>
                    <td>{{ $vrijwilliger->id }}</td>
                    <td>{{ $vrijwilliger->naam }}</td>
                    <td>{{ $vrijwilliger->voornaam }}</td>

                    <td>{{ $vrijwilliger->email }}</td>
                    <td>{{ $vrijwilliger->straat }} {{ $vrijwilliger->huisnummer }}</td>
                    <td>{{ $vrijwilliger->telefoon }}</td>
                    <td>{{ $vrijwilliger->geboortedatum }}</td>
                    <td>{{ $vrijwilliger->rijksrigisternummer }}</td>
                    <td>{{ $vrijwilliger->tshirtId }}</td>
                    <td>{{ $vrijwilliger->lunchpakket }}</td>


                    <td>
                        <form action="/admin/genres/{{ $vrijwilliger->id }}" method="post">
                            @method('delete')
                            @csrf
                            <div class="btn-group btn-group-sm">
                                <a href="/admin/genres/{{ $vrijwilliger->id }}/edit" class="btn btn-outline-success"
                                   data-toggle="tooltip"
                                   title="Edit {{ $vrijwilliger->naam }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="submit" class="btn btn-outline-danger"
                                        data-toggle="tooltip"
                                        title="Delete {{ $vrijwilliger->naam }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $users->links() }}
@endsection
