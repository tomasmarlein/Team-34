@extends('layouts.template')

@section('title', 'Verenigingen')



@section('main')
    <h1>Verenigingen</h1>
    @include('shared.alert')

    <style>
        .fas fa-minus-square danger{
            color:green;
        }
    </style>


    <div class="row" style="text-align: right;">
        <div class="col-sm-12 mb-2">
            <a href="#!" class="btn btn-outline-success" id="btn-create">
                <i class="fas fa-plus-circle mr-1"></i>Nieuwe vereniging
            </a>
        </div>
    </div>



    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Actief</th>
                <th>Naam</th>
                <th>HoofdVerantwoordelijke</th>
                <th>Rekeningnummer</th>
                <th>BTW Nummer</th>
                <th>Adres</th>
                <th>Acties</th>
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
            loadDropdown();


            $('tbody').on('click', '.btn-delete', function () {
                // Get data attributes from td tag
                let id = $(this).closest('td').data('id');
                let naam = $(this).closest('td').data('naam');
                // Set some values for Noty
                let text = `<p>Verwijder de vereniging <b>${naam}</b>?</p>`;
                let btnText = `Verwijder vereniging`;
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
                let voornaam = $(this).closest('td').data('voornaam');
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
                        loadDropdown();
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
                $('input[name="_method"]').val('post');
                // Show the modal
                $('#modal-vereniging').modal('show');
            });


        });


        // Delete een vereniging
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
                    loadDropdown();
                })
                .fail(function (e) {
                    console.log('error', e);
                });
        }

        // Load genres with AJAX
        function loadTable() {
            $.getJSON('/admin/qryVerenigingen')
                .done(function (data) {
                    console.log(data)
                    // Clear tbody tag
                    $('tbody').empty();
                    // Loop over each item in the array
                    $.each(data, function (key, value) {

                        if (value.actief !== 0) {
                            var actief = "<i style='color: #2a9055' class=\"fas fa-check-square danger\"></i>\n";

                            var buttonIcon = "<i class=\"fas fa-minus-square danger\"></i>\n";
                            var path = "nonactive";
                        } else {
                            var actief = "<i style='color: darkred' class=\"fas fa-minus-square danger\"></i>\n";

                            var buttonIcon = "<i class=\"fas fa-check-square danger\"></i>\n";
                            var path = "active";
                        }

                        var obj = $.grep(value.vereniginglid, function(obj){return obj.id === value.hoofdverantwoordelijke;})[0];
                        if(value.hoofdverantwoordelijke == obj.id){
                            var hoofdv = obj.voornaam + ' ' + obj.naam;
                        }else{
                            var hoofdv = "Geen verantwoordelijke";
                        }

                        let tr = `<tr>
                               <td>${value.id}</td>
                               <td>${actief}</td>
                               <td><a href="verenigingen/${ value.id }">${value.naam}</a></td>
                               <td>${hoofdv}</td>
                               <td>${value.rekeningnr}</td>
                               <td>${value.btwnr}</td>
                               <td>${value.straat} ${value.huisnummer} ${value.postcode} ${value.gemeente}</td>

                               <td data-id="${value.id}"
                                   data-naam="${value.naam}"
                                   data-rekeningnr="${value.rekeningnr}"
                                   data-hoofdvId="${value.rekeningnr}"
                                   data-btwnr="${value.btwnr}"
                                   data-straat="${value.straat}"
                                   data-huisnummer="${value.huisnummer}"
                                   data-postcode="${value.postcode}"
                                   data-gemeente="${value.gemeente}"
                                   data-actief="${value.actief}">
                                    <div class="btn-group btn-group-sm">
                                        <a href="#!" class="btn btn-outline-success btn-edit" data-toggle="tooltip" title="Wijzig ${value.naam}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#!" class="btn btn-outline-danger btn-delete" data-toggle="tooltip" title="Verwijder ${value.naam}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                            <a href="${path}/${value.id}" class="btn btn-outline-secondary btn-actief">
                                               ${buttonIcon}
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






        function loadDropdown() {
            $.getJSON('/admin/getHoofd')
                .done(function (data) {
                    console.log(data)
                    // Clear dropdown
                    $('#hoofdv').empty();
                    // Loop over each item in the array
                    $.each(data, function (key, value) {

                        let options = `<option value="${value.id}">${value.voornaam} ${value.naam}</option>`;
                        // Append row to tbody
                        $('#hoofdv').append(options);

                    });
                })
                .fail(function (e) {
                    console.log('error', e);
                })
        }


    </script>
@endsection

