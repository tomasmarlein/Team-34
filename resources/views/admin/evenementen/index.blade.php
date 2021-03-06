@extends('layouts.template')

@section('title', 'Evenementen')

@section('main')
    <h1>Evenementen</h1>


    <div class="row">
        <div class="col-sm-6 mb-2">
            <input class="form-control" id="myInput" type="text" placeholder="Zoek op naam, email, ...">
        </div>
        <div class="col-sm-6 mb-2" style="text-align: right;">
            <a href="#!" class="btn btn-outline-success" id="btn-create">
                <i class="fas fa-plus-circle mr-1"></i>Nieuw evenement
            </a>
        </div>
    </div>



    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>

                <th style="text-align: center">Naam</th>
                <th>Einddatum</th>
                <th>Startdatum</th>
                <th>Actief</th>
                <th style="text-align: center">Acties</th>
            </tr>
            </thead>
            <tbody id="myTable">

            </tbody>
        </table>
    </div>
    @include('admin.evenementen.modal')
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


        loadTable();
        $(function () {
            loadTable();

            $('tbody').on('click', '.btn-delete', function () {
                // Get data attributes from td tag
                let id = $(this).closest('td').data('id');
                let naam = $(this).closest('td').data('naam');
                // Set some values for Noty
                let text = `<p>Verwijder het evenement <b>${naam}</b>?</p>`;

                let  btnText = `Verwijder evenement`;
                let btnClass = 'btn-danger';
                let type = 'error';
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
                            deleteEvenement(id);
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
                let startdatum = $(this).closest('td').data('startdatum');
                let einddatum = $(this).closest('td').data('einddatum');
                let actief = $(this).closest('td').data('actief');
                // Update the modal
                $('.modal-title').text(`Edit ${naam}`);
                $('form').attr('action', `/admin/evenementen/${id}`);

                $('#naam').val(naam);
                $('#startdatum').val(startdatum);
                $('#einddatum').val(einddatum);

                $('#modal-evenementen #actief').prop('checked', actief == '1');

                $('#actief').val(actief);
                $('input[name="_method"]').val('put');

                // Show the modal
                $('#modal-evenementen').modal('show');
            });

            $('#modal-evenementen form').submit(function (e) {
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
                        $('#modal-evenementen').modal('hide');
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
                $('.modal-title').text(`Nieuw evenement`);

                $('form').attr('action', `/admin/evenementen`);
                $('#naam').val('');
                $('#startdatum').val('');
                $('#einddatum').val('');
                $('#actief').val('');
                $('input[name="_method"]').val('post');

                // Show the modal
                $('#modal-evenementen').modal('show');
            });





        });
        //
        // Delete a
        function deleteEvenement(id) {
            // Delete from the database
            let pars = {
                '_token': '{{ csrf_token() }}',
                '_method': 'delete'
            };
            $.post(`/admin/evenementen/${id}`, pars, 'json')
                .done(function (data) {
                    console.log('data', data);
                    // Show toast
                    console.log({id})
                    console.log()
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


            $.getJSON('qryEvenementen')
                .done(function (data) {
                    // Clear tbody tag

                    console.log(data);
                    $('tbody').empty();
                    // Loop over each item in the array
                    $.each(data, function (key, value) {
                        let tr = `<tr>

                               <td style="text-align: center">${value.naam}</td>
                               <td>${value.startdatum}</td>
                               <td>${value.einddatum}</td>
                               <td>${value.actief}</td>

                               <td style="text-align: center"
                               data-id="${value.id}"
                                   data-startdatum="${value.startdatum}"
                                   data-einddatum="${value.einddatum}"
                                   data-naam="${value.naam}"
                                   data-actief="${value.actief}">
                                    <div class="btn-group btn-group-sm">
                                        <a href="evenementen/${ value.id }" class="btn btn-outline-info " data-toggle="tooltip" title="Bekijk verenigingen">
                                            <i class="fas fa-bars"></i>
                                        </a><a href="#!" class="btn btn-outline-success btn-edit" data-toggle="tooltip" title="Wijzig ${value.naam}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#!" class="btn btn-outline-danger btn-delete" data-toggle="tooltip" title="Verwijder ${value.naam}">
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

