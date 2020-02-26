@extends('layouts.template')

@section('title', 'Admin')

@section('main')
    <h1>Admins</h1>
    @include('shared.alert')



    <div class="row">
        <div class="col-sm-6 mb-2">
            <input class="form-control" id="myInput" type="text" placeholder="Zoek op naam, email, ...">
        </div>
        <div class="col-sm-6 mb-2" style="text-align: right;">
            <a href="#!" class="btn btn-outline-success" id="btn-create">
                <i class="fas fa-plus-circle mr-1"></i>Nieuwe admin
            </a>
        </div>
    </div>



    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>

                <th style="text-align: center">Naam</th>
                <th>Email</th>
                <th>Telefoon</th>
                <th>Geboortedatum</th>
                <th style="text-align: center">Acties</th>
            </tr>
            </thead>
            <tbody id="myTable">

            </tbody>
        </table>
    </div>
    @include('admin.admin.modal')
@endsection

@section('script_after')
    <script>

        // search table
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });


        $(function () {
            loadTable();

            $('tbody').on('click', '.btn-delete', function () {
                // Get data attributes from td tag
                let id = $(this).closest('td').data('id');
                let naam = $(this).closest('td').data('naam');
                let voornaam = $(this).closest('td').data('voornaam');
                // Set some values for Noty
                let text = `<p>Verwijder adin: <b>${voornaam} ${naam}</b>?</p>`;
                let type = 'warning';
                let btnText = 'Verwijder Admin';
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
                let rolid = $(this).closest('td').data('rolid');
                let naam = $(this).closest('td').data('naam');
                let voornaam = $(this).closest('td').data('voornaam');
                let email = $(this).closest('td').data('email');
                let telefoon = $(this).closest('td').data('telefoon');
                let geboortedatum = $(this).closest('td').data('geboortedatum');
                // Update the modal
                $('.modal-title').text(`Wijzig ${voornaam} ${naam}`);
                $('form').attr('action', `/admin/Admin/${id}`);

                $('#naam').val(naam);
                $('#voornaam').val(voornaam);
                $('#email').val(email);
                $('#telefoon').val(telefoon);
                $('#geboortedatum').val(geboortedatum);
                $('#dropdown-rol').val('1');
                $('#wachtwoord').val('De persoon moet dit zelf aanpassen.');
                $("#wachtwoord").attr("disabled", true);
                $("#wachtwoord").prop('type', 'text');

                $('input[name="_method"]').val('put');
                // Show the modal
                $('#modal-admin').modal('show');
            });

            $('#modal-admin form').submit(function (e) {
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
                            type: data.type,
                            text: data.text
                        }).show();
                        // Hide the modal
                        $('#modal-admin').modal('hide');
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
                $('.modal-title').text(`Nieuwe admin`);
                $('form').attr('action', `/admin/Admin`);
                $("#wachtwoord").attr("disabled", false);
                $("#wachtwoord").prop('type', 'password');
                $('#naam').val('');
                $('#voornaam').val('');
                $('#email').val('');
                $('#telefoon').val('');
                $('#geboortedatum').val('');
                $('#wachtwoord').val('');
                $('#dropdown-rol').val('leeg');
                $('input[name="_method"]').val('post');
                // Show the modal
                $('#modal-admin').modal('show');
            });
        });

        // Delete a genre
        function deleteGebruiker(id) {
            // Delete the genre from the database
            let pars = {
                '_token': '{{ csrf_token() }}',
                '_method': 'delete'
            };
            $.post(`/admin/Admin/${id}`, pars, 'json')
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
            $.getJSON('/admin/qryAdmins')
                .done(function (data) {
                    console.log('data', data);
                    // Clear tbody tag
                    $('tbody').empty();
                    // Loop over each item in the array
                    $.each(data, function (key, value) {

                        if(value.telefoon != null){
                            var telefoon = value.telefoon;
                        } else {
                            var telefoon = 'Geen telefoon';
                        }

                        if(value.geboortedatum != null){
                            var geboortedatum = value.geboortedatum;
                        } else {
                            var geboortedatum = 'Geen geboortedatum';
                        }

                        let tr = `<tr>

                               <td align="ceenter">${value.naam} ${value.voornaam}</td>
                               <td>${value.email}</td>
                               <td>${telefoon}</td>
                               <td>${geboortedatum}</td>


                               <td align="center"
                                   data-id="${value.id}"
                                   data-naam="${value.naam}"
                                   data-voornaam="${value.voornaam}"
                                   data-email="${value.email}"
                                   data-geboortedatum="${value.geboortedatum}"
                                   data-telefoon="${value.telefoon}"
                                   data-rolid="${value.rolId}>

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
                    });
                })
                .fail(function (e) {
                    console.log('error', e);
                })
        }
    </script>
@endsection
