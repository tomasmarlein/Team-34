@extends('layouts.template')

@section('title', 'Vereniging')

@section('main')
    <h1>Jouw Vereniging</h1>
    @include('shared.alert')

    <style>
        .fas fa-minus-square danger{
            color:green;
        }
    </style>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Naam</th>
                <th>Rekeningnummer</th>
                <th>BTW Nummer</th>
                <th>Adres</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
@endsection

@section('script_after')
    <script>
        $(function () {
            loadTable();
        });

        function loadTable() {
            $.getJSON('getVereniging')
                .done(function (data) {
                    console.log(data)
                    // Clear tbody tag
                    $('tbody').empty();
                    // Loop over each item in the array
                    $.each(data, function (key, value) {

                        let tr = `<tr>
                               <td>${value.id}</td>
                               <td><a href="showLeden/${ value.id }">${value.naam}</a></td>
                               <td>${value.rekeningnr}</td>
                               <td>${value.btwnr}</td>
                               <td>${value.straat} ${value.huisnummer} ${value.postcode} ${value.gemeente}</td>
                           </tr>`;
                        // Append row to tbody
                        $('tbody').append(tr);

                    });
                })
                .fail(function (e) {
                    console.log('error', e);
                })
        }

    </script>
@endsection

