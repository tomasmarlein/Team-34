@extends('layouts.template')

@section('title', 'Vrijwilligers')
@section('css_after')
    <style>
        .upload{
            position:absolute;
            right: 18%;
            top: 12%;
        }

        .download{
            position: absolute;
            right: 13.7%;
            top: 12%;
        }
    </style>
@endsection
@section('main')
    <h1>Vrijwilligers</h1>
    @include('shared.alert')

    <div class="upload">
        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input style="height: 45px" type="file" name="file" class="form-control" id="uploadFile">
            <button style="color: #0C225D; background-color: #FFCF5D; border-color: #FFCF5D" class="btn btn-success" id="importeerVrijwilliger">Voeg vrijwilligers toe</button>
        </form>
    </div>
    <div class="download">
        <form style="text-align: right" action="{{url('admin/download')}}" method="get" >
            <button data-toggle="tooltip" title="Exporteer alle vrijwilligers" style="height: 45px; width:55px ;color: #0C225D; background-color: #FFCF5D; border-color: #FFCF5D" type="submit" class="btn btn-primary btn-lg btn-block">
                <i class="fas fa-download"></i>
            </button>
        </form>
    </div>
    <br>

    <form method="get" action="/admin/vrijwilligers" id="searchForm">
        <div class="row">
            <div class="col-sm-3 mb-2">
                <label for="name">Filter op naam: </label>
                <input type="text" class="form-control" name="name" id="name"
                       value="{{ request()->name }}" placeholder="Naam">
            </div>
            <div class="col-sm-3 mb-2">
                <label for="emailadres">Filter op e-mail adres: </label>
                <input type="email" class="form-control" name="" id="emailadres"
                       value="" placeholder="E-mail adres">
            </div>
            <div class="col-sm-3 mb-2">
                <label for="sort">Sorteer op: </label>
                <select class="form-control" name="" id="sort">
                    <option value="%" selected>Naam (A => Z)</option>
                    <option value="%">Naam (Z => A)</option>
                    <option value="%">E-mail (A => Z)</option>
                    <option value="%">E-mail (Z => A)</option>
                    <option value="%">Vereniging</option>
                </select>
            </div>
            <div class="col-sm-3 mb-2">
                <label>Voeg toe: </label><br>
                <a href="#!" class="btn btn-outline-success" id="btn-create">
                    <i class="fas fa-plus-circle mr-1"></i>Nieuwe vrijwiliger
                </a>
            </div>
        </div>
    </form>


            <div class="table-responsive">
                <table id="mytable" class="table table-hover">
                    <thead class="shadow">
                    <tr>
                        <th>#</th>
                        <th>Naam</th>
                        <th>Vereniging</th>
                        <th>Email</th>
                        <th>Telefoon</th>
                        <th>Geboortedatum</th>
                        <th>Acties</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>



    @include('admin.vrijwilligers.modal')
@endsection

@section('script_after')
    <script>

        $( document ).ready(function() {
            var inp = $("input[id='rijksregisternr'] ");
            inp.bind('keyup', function(){
                this.value = this.value.replace(/[^0-9]/,'');
            });
        });


        $(function () {
            $('#importeerVrijwilliger').hide();

            $("#uploadFile").change(function (){
                $('#importeerVrijwilliger').show();
            });

            // submit form when leaving text field 'artist'
            $('#name').blur(function () {
                $('#searchForm').submit();
            });


            loadTable();

            $('tbody').on('click', '.btn-delete', function () {
                // Get data attributes from td tag
                let id = $(this).closest('td').data('id');
                let naam = $(this).closest('td').data('naam');
                let voornaam = $(this).closest('td').data('voornaam');
                // Set some values for Noty
                let text = `<p>Verwijder de vrijwilliger <b>${voornaam} ${naam}</b>?</p>`;
                let type = 'warning';
                let btnText = 'Verwijder vrijwilliger';
                let btnClass = 'btn-danger';

                // Show Noty
                let modal = new Noty({
                    timeout: false,
                    layout: 'center',
                    modal: true,
                    type: type,
                    text: text,
                    buttons: [
                        Noty.button(btnText, `btn ${btnClass}`, function () {
                            // Delete genre and close modal
                            deleteGebruiker(id);
                            modal.close();
                        }),
                        Noty.button('Annuleer', 'btn btn-secondary ml-2', function () {
                            modal.close();
                        })
                    ]
                }).show();
            });

            $('tbody').on('click', '.btn-edit', function () {
                // Get data attributes from td tag
                let id = $(this).closest('td').data('id');
                let naam = $(this).closest('td').data('naam');
                let voornaam = $(this).closest('td').data('voornaam');
                let roepnaam = $(this).closest('td').data('roepnaam');
                let email = $(this).closest('td').data('email');
                let telefoon = $(this).closest('td').data('telefoon');
                let geboortedatum = $(this).closest('td').data('geboortedatum');
                let rijksregisternr = $(this).closest('td').data('rijksregisternr');
                // Update the modal
                $('.modal-title').text(`Edit ${voornaam} ${naam}`);
                $('form').attr('action', `/admin/vrijwilligers/${id}`);

                $('#naam').val(naam);
                $('#voornaam').val(voornaam);
                $('#roepnaam').val(roepnaam);
                $('#email').val(email);
                $('#telefoon').val(telefoon);
                $('#geboortedatum').val(geboortedatum);
                $('#rijksregisternr').val(rijksregisternr);

                $('input[name="_method"]').val('put');
                // Show the modal
                $('#modal-vrijwilliger').modal('show');
            });

            $('#modal-vrijwilliger form').submit(function (e) {
                // Don't submit the form
                e.preventDefault();
                // Get the action property (the URL to submit)
                let action = $(this).attr('action');
                // Serialize the form and send it as a parameter with the post
                let pars = $(this).serialize();
                console.log(pars);
                // Post the data to the URL
                $.post(action, pars, 'json')
                    .done(function (data) {
                        console.log(data);
                        // Noty success message
                        new Noty({
                            icon: data.icon,
                            type: data.type,
                            text: data.text
                        }).show();
                        // Hide the modal
                        $('#modal-vrijwilliger').modal('hide');
                        // Rebuild the table
                        loadTable();
                    })
                    .fail(function (e) {
                        console.log('error', e);
                        // e.responseJSON.errors contains an array of all the validation errors
                        console.log('error message', e.responseJSON.errors);
                        // Loop over the e.responseJSON.errors array and create an ul list with all the error messages
                        let msg = '<ul>';
                        $.each(e.responseJSON.errors, function (key, value) {
                            msg += `<li>${value}</li>`;
                        });
                        msg += '</ul>';
                        // Noty the errors
                        new Noty({
                            type: 'error',
                            text: msg
                        }).show();
                    });
            });

            $('#btn-create').click(function () {
                // Update the modal
                $('.modal-title').text(`Nieuwe gebruiker`);
                $('form').attr('action', `/admin/vrijwilligers`);
                $('#naam').val('');
                $('input[name="_method"]').val('post');
                // Show the modal
                $('#modal-vrijwilliger').modal('show');
            });



        });

        // Delete a genre
        function deleteGebruiker(id) {
            // Delete the genre from the database
            let pars = {
                '_token': '{{ csrf_token() }}',
                '_method': 'delete'
            };
            $.post(`/admin/vrijwilligers/${id}`, pars, 'json')
                .done(function (data) {
                    console.log('data', data);
                    // Show toast
                    new Noty({
                        type: data.type,
                        text: data.text
                    }).show();
                    // Rebuild the table
                    loadTable();
                })
                .fail(function (e) {
                    console.log('error', e);
                });
        }



        // Load genres with AJAX
        function loadTable() {
            $.getJSON('/admin/qryVrijwilligers')
                .done(function (data) {
                    console.log('data', data);
                    // Clear tbody tag
                    $('tbody').empty();
                    // Loop over each item in the array
                    $.each(data, function (key, value) {
                        if(value.lid.length != 0){
                            for(var i=0; i<value.lid.length; i++) {
                                var verenigingnaam = value.lid[i].naam;

                                if (value.telefoon == null) {
                                    var telefoon = '/'
                                } else {
                                    var telefoon = value.telefoon
                                }

                                if (value.geboortedatum == null) {
                                    var geboortedatum = '/'
                                } else {
                                    var geboortedatum = value.geboortedatum
                                }

                                let tr = `<tr>
                               <td>${value.id}</td>
                               <td>${value.naam} ${value.voornaam}</td>
                               <td>${verenigingnaam}</td>
                               <td>${value.email}</td>
                               <td>${telefoon}</td>
                               <td>${geboortedatum}</td>


                               <td data-id="${value.id}"
                                   data-naam="${value.naam}"
                                   data-voornaam="${value.voornaam}"
                                   data-roepnaam="${value.roepnaam}"
                                   data-email="${value.email}"
                                   data-geboortedatum="${value.geboortedatum}"
                                   data-telefoon="${value.telefoon}">

                                    <div class="btn-group btn-group-sm">
                                        <a href="#!" class="btn btn-outline-success btn-edit" data-toggle="tooltip" title="Wijzig ${value.naam} ${value.voornaam}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#!" class="btn btn-outline-danger btn-delete" data-toggle="tooltip" title="Verwijder ${value.naam} ${value.voornaam}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                               </td>
                           </tr>`;
                                // Append row to tbody
                                $('tbody').append(tr);
                            }
                        } else {
                                    var verenigingnaam = 'Geen vereniging';

                                if (value.telefoon == null) {
                                    var telefoon = '/'
                                } else {
                                    var telefoon = value.telefoon
                                }

                                if (value.geboortedatum == null) {
                                    var geboortedatum = '/'
                                } else {
                                    var geboortedatum = value.geboortedatum
                                }

                                let tr = `<tr>
                               <td>${value.id}</td>
                               <td>${value.naam} ${value.voornaam}</td>
                               <td>${verenigingnaam}</td>
                               <td>${value.email}</td>
                               <td>${telefoon}</td>
                               <td>${geboortedatum}</td>


                               <td data-id="${value.id}"
                                   data-naam="${value.naam}"
                                   data-voornaam="${value.voornaam}"
                                   data-roepnaam="${value.roepnaam}"
                                   data-email="${value.email}"
                                   data-geboortedatum="${value.geboortedatum}"
                                   data-telefoon="${value.telefoon}"
                                   data-rijksregisternr="${value.rijksregisternr}">

                                    <div class="btn-group btn-group-sm">
                                        <a href="#!" class="btn btn-outline-success btn-edit" data-toggle="tooltip" title="Wijzig ${value.naam} ${value.voornaam}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#!" class="btn btn-outline-danger btn-delete" data-toggle="tooltip" title="Verwijder ${value.naam} ${value.voornaam}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                               </td>
                           </tr>`;
                                // Append row to tbody
                                $('tbody').append(tr);

                        }

                    });
                })
                .fail(function (e) {
                    console.log('error', e);
                })
        }
    </script>
@endsection
