@extends('layouts.template')
@section('title', 'Verantwoordelijkebeheer')


@section('main')
    <div>
        <h1>Overzicht verantwoordelijken</h1>


        <div class="table-responsive">
            <table id="verant-table" class="table table-striped">
                <thead>
                <tr>
                    <th>Vereniging</th>
                    <th>Type</th>
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
                        for(var i = 0; i<value.vereniginglid.length; i++){
                            if(value.vereniginglid[i].id == value.hoofdverantwoordelijke){
                                let tr = `<tr>
                               <td>${value.naam}</td>
                               <td>Hoofdverantwoordelijke</td>
                               <td>${value.vereniginglid[i].naam} ${value.vereniginglid[i].voornaam}</td>
                               <td>${value.vereniginglid[i].email}</td>
                               <td>${value.vereniginglid[i].telefoon}</td>
                               <td data-id="${value.vereniginglid[i].id}"
                                   data-naam="${value.vereniginglid[i].naam}"
                                   data-voornaam="${value.vereniginglid[i].voornaam}"
                                   data-roepnaam="${value.vereniginglid[i].roepnaam}"
                                   data-email="${value.vereniginglid[i].email}"
                                   data-geboortedatum="${value.vereniginglid[i].geboortedatum}"
                                   data-telefoon="${value.vereniginglid[i].telefoon}"
                                   data-rijksregisternummer="${value.vereniginglid[i].rijksregisternr}">
                               </td>
                           </tr>`;
                                $('tbody').append(tr);
                            } if(value.vereniginglid[i].id == value.tweedeverantwoordelijke) {
                                console.log('tweedeverantwoodelijke klopt')
                                let tr = `<tr>
                               <td>${value.naam}</td>
                               <td>Tweedeverantwoordelijke</td>
                               <td>${value.vereniginglid[i].naam} ${value.vereniginglid[i].voornaam}</td>
                               <td>${value.vereniginglid[i].email}</td>
                               <td>${value.vereniginglid[i].telefoon}</td>
                               <td data-id="${value.vereniginglid[i].id}"
                                   data-naam="${value.vereniginglid[i].naam}"
                                   data-voornaam="${value.vereniginglid[i].voornaam}"
                                   data-roepnaam="${value.vereniginglid[i].roepnaam}"
                                   data-email="${value.vereniginglid[i].email}"
                                   data-geboortedatum="${value.vereniginglid[i].geboortedatum}"
                                   data-telefoon="${value.vereniginglid[i].telefoon}"
                                   data-rijksregisternummer="${value.vereniginglid[i].rijksregisternr}">
                               </td>
                           </tr>`;
                                $('tbody').append(tr);
                        }


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
