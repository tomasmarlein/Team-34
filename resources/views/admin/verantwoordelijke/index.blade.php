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
            </div>
        </form>
        <div class="table-responsive">
            <table id="verant-table" class="table table-striped">
                <thead>
                <tr>
                    <th>Vereniging</th>
                    <th>Naam</th>
                    <th>Email</th>
                    <th>Telefoon</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    @include('admin.verantwoordelijke.modal')
@endsection
@section('script_after')
    <script>
        $(function () {
            loadTable();
        });

        //tabel inladen
        function loadTable() {
            $.getJSON('qryVerantwoordelijke')
                .done(function (data) {
                    console.log('data', data);
                    // Clear tbody tag
                    $('tbody').empty();
                    // Loop over each item in the array
                    $.each(data, function (key, value) {
                        let tr = "";
                        console.log(value.vereniginglid.length);
                        if(value.vereniginglid.length == 1){
                            let tr = `<tr>
                               <td>${value.naam}</td>
                               <td>${value.vereniginglid[0].naam} ${value.vereniginglid[0].voornaam}</td>
                               <td>${value.vereniginglid[0].email}</td>
                               <td>${value.vereniginglid[0].telefoon}</td>
                               <td data-id="${value.vereniginglid[0].id}"
                                   data-naam="${value.vereniginglid[0].naam}"
                                   data-voornaam="${value.vereniginglid[0].voornaam}"
                                   data-roepnaam="${value.vereniginglid[0].roepnaam}"
                                   data-email="${value.vereniginglid[0].email}"
                                   data-geboortedatum="${value.vereniginglid[0].geboortedatum}"
                                   data-telefoon="${value.vereniginglid[0].telefoon}"
                                   data-rijksregisternummer="${value.vereniginglid[0].rijksregisternr}">
                               </td>
                           </tr>`;
                            $('tbody').append(tr);
                        } else {
                            let tr = `<tr>
                               <td>${value.naam}</td>
                               <td>${value.vereniginglid[0].naam} ${value.vereniginglid[0].voornaam}</td>
                               <td>${value.vereniginglid[0].email}</td>
                               <td>${value.vereniginglid[0].telefoon}</td>
                               <td data-id="${value.vereniginglid[0].id}"
                                   data-naam="${value.vereniginglid[0].naam}"
                                   data-voornaam="${value.vereniginglid[0].voornaam}"
                                   data-roepnaam="${value.vereniginglid[0].roepnaam}"
                                   data-email="${value.vereniginglid[0].email}"
                                   data-geboortedatum="${value.vereniginglid[0].geboortedatum}"
                                   data-telefoon="${value.vereniginglid[0].telefoon}"
                                   data-rijksregisternummer="${value.vereniginglid[0].rijksregisternr}">
                               </td>
                           </tr><tr>
                               <td>${value.naam}</td>
                               <td>${value.vereniginglid[1].naam} ${value.vereniginglid[1].voornaam}</td>
                               <td>${value.vereniginglid[1].email}</td>
                               <td>${value.vereniginglid[1].telefoon}</td>
                               <td data-id="${value.vereniginglid[1].id}"
                                   data-naam="${value.vereniginglid[1].naam}"
                                   data-voornaam="${value.vereniginglid[1].voornaam}"
                                   data-roepnaam="${value.vereniginglid[1].roepnaam}"
                                   data-email="${value.vereniginglid[1].email}"
                                   data-geboortedatum="${value.vereniginglid[1].geboortedatum}"
                                   data-telefoon="${value.vereniginglid[1].telefoon}"
                                   data-rijksregisternummer="${value.vereniginglid[1].rijksregisternr}">
                               </td>
                           </tr>`;
                            $('tbody').append(tr);
                        }
                    });
                    $('[data-toggle="tooltip"]').tooltip({
                        'html': true,
                    });
                })
                .fail(function (e) {
                    console.log('error', e);
                });
        }
    </script>
    @endsection
