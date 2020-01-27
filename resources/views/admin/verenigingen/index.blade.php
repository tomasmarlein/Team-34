@extends('layouts.template')

@section('title', 'Verenigingen')

@section('main')
    <h1>Verenigingen</h1>
    @include('shared.alert')
    <form method="get" action="#" id="searchForm">
        <div class="row">
            <div class="col-sm-6 mb-2">
                <p>Filter Naam of Email</p>
                <input type="text" class="form-control" name="artist" id="artist"
                       value="" placeholder="Filter Name Or Email">
            </div>
            <div class="col-sm-4 mb-2">
                <p>sort</p>
                <select class="form-control" name="#" id="#">
                    <option>naam (A=>Z)</option>
                </select>
            </div>
            <div class="col-sm-3 mb-2">
                <label>Voeg toe</label><br>
                <a href="#!" class="btn btn-outline-success" id="btn-create">
                    <i class="fas fa-plus-circle mr-1"></i>Nieuwe vereniging
                </a>
            </div>
        </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Naam</th>
                <th>HoofdVerantwoordelijke</th>
                <th>Rekeningnummer</th>
                <th>BTW Nummer</th>
                <th>Adres</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    @include('admin.verenigingen.modal')
@endsection

@section('script_after')
    <script>
        $(function () {
            loadTable();

            $('tbody').on('click', '.btn-delete', function () {
                // Get data attributes from td tag
                let id = $(this).closest('td').data('id');
                let naam = $(this).closest('td').data('naam');
                // Set some values for Noty
                let text = `<p>Verwijder de vereniging <b>${naam}</b>?</p>`;
                  let  btnText = `Verwijder vereniging`;
                   let btnClass = 'btn-danger';
                   let type = 'warning';
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
                            deleteVereniging(id);
                            modal.close();
                        }),
                        Noty.button('Cancel', 'btn btn-secondary ml-2', function () {
                            modal.close();
                        })
                    ]
                }).show();
            });

            $('tbody').on('click', '.btn-edit', function () {
                // Get data attributes from td tag
                let id = $(this).closest('td').data('id');
                let naam = $(this).closest('td').data('naam');
                let hoofdverantwoordelijke = $(this).closest('td').data('hoofdverantwoordelijke');
                let rekeningnr = $(this).closest('td').data('rekeningnr');
                let btwnr = $(this).closest('td').data('btwnr');
                let straat = $(this).closest('td').data('straat');
                let huisnummer = $(this).closest('td').data('huisnummer');
                let postcode = $(this).closest('td').data('postcode');
                let gemeente = $(this).closest('td').data('gemeente');

                // Update the modal
                $('.modal-title').text(`Edit ${naam}`);
                $('form').attr('action', `/admin/verenigingen/${id}`);

                $('#naam').val(naam);
                $('#hoofdverantwoordelijke').val(hoofdverantwoordelijke);
                $('#rekeningnr').val(rekeningnr);
                $('#btwnr').val(btwnr);
                $('#straat').val(straat);
                $('#huisnummer').val(huisnummer);
                $('#postcode').val(postcode);
                $('#gemeente').val(gemeente);

                $('input[name="_method"]').val('put');
                // Show the modal
                $('#modal-vereniging').modal('show');
            });

            $('#modal-vereniging form').submit(function (e) {
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
                        $('#modal-vereniging').modal('hide');
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
                $('.modal-title').text(`Nieuwe vereniging`);
                $('form').attr('action', `/admin/verenigingen`);
                $('#naam').val('');
                // $('#hoofdverantwoordelijke').val('');
                // $('#rekeningnr').val(rekeningnr);
                // $('#btwnr').val(btwnr);
                // $('#straat').val(straat);
                // $('#huisnummer').val(huisnummer);
                // $('#postcode').val(postcode);
                // $('#gemeente').val(gemeente);
                $('input[name="_method"]').val('post');

                // Show the modal
                $('#modal-vereniging').modal('show');
            });

        });

        // Delete a genre
        function deleteVereniging(id) {
            // Delete the vereniging from the database
            let pars = {
                '_token': '{{ csrf_token() }}',
                '_method': 'delete'
            };
            $.post(`/admin/verenigingen/${id}`, pars, 'json')
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
            $.getJSON('qryVerenigingen')
                .done(function (data) {
                    // Clear tbody tag
                    $('tbody').empty();
                    // Loop over each item in the array
                    $.each(data, function (key, value) {
                        let tr = `<tr>
                               <td>${value.id}</td>
                               <td>${value.naam}</td>
                               <td>${value.hoofdverantwoordelijke}</td>
                               <td>${value.rekeningnr}</td>
                               <td>${value.btwnr}</td>
                               <td>${value.straat} ${value.huisnummer} ${value.postcode} ${value.gemeente}</td>

                               <td data-id="${value.id}"
                                   data-naam="${value.naam}"
                                   data-hoofdverantwoordelijke="${value.hoofdverantwoordelijke}"
                                   data-rekeningnr="${value.rekeningnr}"
                                   data-btwnr="${value.btwnr}"
                                   data-straat="${value.straat}"
                                   data-huisnummer="${value.huisnummer}"
                                   data-postcode="${value.postcode}"
                                   data-gemeente="${value.gemeente}">
                                    <div class="btn-group btn-group-sm">
                                        <a href="#!" class="btn btn-outline-success btn-edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#!" class="btn btn-outline-danger btn-delete">
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

