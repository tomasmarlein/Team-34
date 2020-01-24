@extends('layouts.template')

@section('title', 'Evenementen')

@section('main')
    <h1>Evenementen</h1>
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
                    <i class="fas fa-plus-circle mr-1"></i>Nieuwe evenement
                </a>
            </div>
        </div>


    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Startdatum</th>
                <th>Einddatum</th>
                <th>Naam</th>
                <th>Actief</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
{{--    @include('admin.evenementen.modal')--}}
@endsection

@section('script_after')
    <script>


        loadTable();
        // $(function () {
        //     loadTable();
        //
        //     $('tbody').on('click', '.btn-delete', function () {
        //         // Get data attributes from td tag
        //         let id = $(this).closest('td').data('id');
        //         let naam = $(this).closest('td').data('name');
        //         // Set some values for Noty
        //         let text = `<p>Verwijder de vereniging <b>${naam}</b>?</p>`;
        //
        //         let  btnText = `Verwijder vereniging`;
        //         let btnClass = 'btn-danger';
        //         let type = 'error';
        //         // Show Noty
        //         let modal = new Noty({
        //             timeout: false,
        //             layout: 'center',
        //             modal: true,
        //             type: type,
        //             text: text,
        //             buttons: [
        //                 Noty.button(btnText, `btn ${btnClass}`, function () {
        //                     // Delete genre and close modal
        //                     deleteVereniging(id);
        //                     modal.close();
        //                 }),
        //                 Noty.button('Cancel', 'btn btn-secondary ml-2', function () {
        //                     modal.close();
        //                 })
        //             ]
        //         }).show();
        //     });
        //
        //     $('tbody').on('click', '.btn-edit', function () {
        //         // Get data attributes from td tag
        //         let id = $(this).closest('td').data('id');
        //         let naam = $(this).closest('td').data('naam');
        //         let hoofdverantwoordelijke = $(this).closest('td').data('hoofdverantwoordelijke');
        //         let rekeningnr = $(this).closest('td').data('rekeningnr');
        //         let btwnr = $(this).closest('td').data('btwnr');
        //         let straat = $(this).closest('td').data('straat');
        //         let huisnummer = $(this).closest('td').data('huisnummer');
        //         let postcode = $(this).closest('td').data('postcode');
        //         let gemeente = $(this).closest('td').data('gemeente');
        //         // Update the modal
        //         $('.modal-title').text(`Edit ${naam}`);
        //         $('form').attr('action', `/admin/verenigingen/${id}`);
        //         $('#naam').val(naam);
        //         $('input[naam="_method"]').val('put');
        //         $('#hoofdverantwoordelijke').val(hoofdverantwoordelijke);
        //         $('input[hoofdverantwoordelijke="_method"]').val('put');
        //         $('#rekeningnr').val(rekeningnr);
        //         $('input[rekeningnr="_method"]').val('put');
        //         $('#btwnr').val(btwnr);
        //         $('input[btwnr="_method"]').val('put');
        //         $('#straat').val(straat);
        //         $('input[straat="_method"]').val('put');
        //         $('#huisnummer').val(huisnummer);
        //         $('input[huisnummer="_method"]').val('put');
        //         $('#postcode').val(postcode);
        //         $('input[postcode="_method"]').val('put');
        //         $('#gemeente').val(gemeente);
        //         $('input[gemeente="_method"]').val('put');
        //         // Show the modal
        //         $('#modal-vereniging').modal('show');
        //     });
        //
        //     $('#modal-vereniging form').submit(function (e) {
        //         // Don't submit the form
        //         e.preventDefault();
        //         // Get the action property (the URL to submit)
        //         let action = $(this).attr('action');
        //         // Serialize the form and send it as a parameter with the post
        //         let pars = $(this).serialize();
        //         console.log(pars);
        //         // Post the data to the URL
        //         $.post(action, pars, 'json')
        //             .done(function (data) {
        //                 console.log(data);
        //                 // Noty success message
        //                 new Noty({
        //                     type: data.type,
        //                     text: data.text
        //                 }).show();
        //                 // Hide the modal
        //                 $('#modal-vereniging').modal('hide');
        //                 // Rebuild the table
        //                 loadTable();
        //             })
        //             .fail(function (e) {
        //                 console.log('error', e);
        //                 // e.responseJSON.errors contains an array of all the validation errors
        //                 console.log('error message', e.responseJSON.errors);
        //                 // Loop over the e.responseJSON.errors array and create an ul list with all the error messages
        //                 let msg = '<ul>';
        //                 $.each(e.responseJSON.errors, function (key, value) {
        //                     msg += `<li>${value}</li>`;
        //                 });
        //                 msg += '</ul>';
        //                 // Noty the errors
        //                 new Noty({
        //                     type: 'error',
        //                     text: msg
        //                 }).show();
        //             });
        //     });
        //
        //     $('#btn-create').click(function () {
        //         // Update the modal
        //         $('.modal-title').text(`Nieuwe vereniging`);
        //
        //         $('form').attr('action', `/admin/verenigingen`);
        //
        //         console.log(naam);
        //
        //         $('#naam').val(naam);
        //         $('input[name="_method"]').val('post');
        //         // $('#hoofdverantwoordelijke').val(hoofdverantwoordelijke);
        //         // $('input[hoofdverantwoordelijke="_method"]').val('post');
        //         //
        //         //
        //         // $('#rekeningnr').val(rekeningnr);
        //         // $('input[rekeningnr="_method"]').val('post');
        //         // $('#btwnr').val(btwnr);
        //         // $('input[btwnr="_method"]').val('post');
        //         // $('#straat').val(straat);
        //         // $('input[straat="_method"]').val('post');
        //         // $('#huisnummer').val(huisnummer);
        //         // $('input[huisnummer="_method"]').val('post');
        //         // $('#postcode').val(postcode);
        //         // $('input[postcode="_method"]').val('post');
        //         // $('#gemeente').val(gemeente);
        //         // $('input[gemeente="_method"]').val('post');
        //         console.log(naam);
        //         // Show the modal
        //         $('#modal-vereniging').modal('show');
        //     });
        //
        // });

        {{--// Delete a genre--}}
        {{--function deleteVereniging(id) {--}}
        {{--    // Delete the vereniging from the database--}}
        {{--    let pars = {--}}
        {{--        '_token': '{{ csrf_token() }}',--}}
        {{--        '_method': 'delete'--}}
        {{--    };--}}
        {{--    $.post(`/admin/verenigingen/${id}`, pars, 'json')--}}
        {{--        .done(function (data) {--}}
        {{--            console.log('data', data);--}}
        {{--            // Show toast--}}
        {{--            console.log({id})--}}
        {{--            console.log()--}}
        {{--            new Noty({--}}
        {{--                type: data.type,--}}
        {{--                text: data.text--}}
        {{--            }).show();--}}
        {{--            // Rebuild the table--}}
        {{--            loadTable();--}}
        {{--        })--}}
        {{--        .fail(function (e) {--}}
        {{--            console.log('error', e);--}}
        {{--        });--}}
        {{--}--}}

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
                               <td>${value.id}</td>
                               <td>${value.startdatum}</td>
                               <td>${value.einddatum}</td>
                               <td>${value.naam}</td>
                               <td>${value.actief}</td>

                               <td data-id="${value.id}"
                                   data-name="${value.naam}">
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

