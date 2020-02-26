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
                <th>Goedgekeurd</th>
                <th>Naam</th>
                <th>Rekeningnummer</th>
                <th>BTW Nummer</th>
                <th>Adres</th>
                <th>Wijzigen</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

        <h2>Waneer <i style='color: #2a9055' class="fas fa-check-square danger"></i> bij goedgekeurd staat is je vereniging in orde. Dit word zo snel mogelijk afgehandeld door een beheerder.</h2>
    </div>

     @include('verantwoordelijke.modalVereniging')
@endsection

@section('script_after')
    <script>
        $(function () {
            loadTable();
        });

        $('tbody').on('click', '.btn-edit', function () {
            // Get data attributes from td tag
            let id = $(this).closest('td').data('id');
            let naam = $(this).closest('td').data('naam');
            let voornaam = $(this).closest('td').data('voornaam');
            let rekeningnr = $(this).closest('td').data('rekeningnr');
            let btwnr = $(this).closest('td').data('btwnr');
            let straat = $(this).closest('td').data('straat');
            let huisnummer = $(this).closest('td').data('huisnummer');
            let postcode = $(this).closest('td').data('postcode');
            let gemeente = $(this).closest('td').data('gemeente');

            // Update the modal
            $('.modal-title').text(`Wijzig ${naam}`);
            $('form').attr('action', `/verantwoordelijke/verenigingen/${id}`);
            $('#naam').val(naam);
            $('#voornaam').val(voornaam);
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
            console.log(pars + action);
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
                    $('#modal-vereniging').modal('hide');
                    location.reload();

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

        function loadTable() {
            $.getJSON('getVereniging')
                .done(function (data) {
                    console.log(data)
                    // Clear tbody tag
                    $('tbody').empty();
                    // Loop over each item in the array
                    $.each(data, function (key, value) {
                        if (value.inaanvraag !== 1) {
                            var actief = "<i style='color: #2a9055' class=\"fas fa-check-square danger\"></i>\n";
                        } else {
                            var actief = "<i style='color: darkred' class=\"fas fa-minus-square danger\"></i>\n";
                        }
                        let tr = `<tr>
                               <td>${value.id}</td>
                               <td>${actief}</td>
                               <td><a href="showLeden/${ value.id }">${value.naam}</a></td>
                               <td>${value.rekeningnr}</td>
                               <td>${value.btwnr}</td>
                               <td>${value.straat} ${value.huisnummer} ${value.postcode} ${value.gemeente}</td>
                               <td data-id="${value.id}"
                                   data-naam="${value.naam}"
                                   data-rekeningnr="${value.rekeningnr}"
                                   data-btwnr="${value.btwnr}"
                                   data-straat="${value.straat}"
                                   data-huisnummer="${value.huisnummer}"
                                   data-postcode="${value.postcode}"
                                   data-gemeente="${value.gemeente}"
                                   data-actief="${value.actief}">

                            <div class="btn-group btn-group-sm">
                                        <a href="#!" class="btn btn-outline-success btn-edit" id="btn-edit" name="btn-edit" data-toggle="tooltip" title="Wijzig ${value.naam}">
                                            <i class="fas fa-edit"></i>
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
        }

    </script>
@endsection

