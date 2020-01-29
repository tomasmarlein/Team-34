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
                <div class="col-sm-4 mb-2">
                    <p>sort</p>
                    <select class="form-control" name="#" id="#">
                        <option>naam (A=>Z)</option>
                    </select>
                </div>
                <div class="col-sm-3 mb-2">
                    <label>Voeg toe</label><br>
                    <a href="#!" class="btn btn-outline-success" id="btn-create">
                        <i class="fas fa-plus-circle mr-1"></i>Nieuwe verantwoordelijke
                    </a>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Vereniging</th>
                    <th>Naam</th>
                    <th>Voornaam</th>
                    <th>Email</th>
                    <th>Telefoon</th>
                    <th>Adres</th>
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
            loadDropdown();

            $('tbody').on('click', '.btn-edit', function () {
                // Get data attributes from td tag
                let id = $(this).closest('td').data('id');
                let naam = $(this).closest('td').data('naam');
                let voornaam = $(this).closest('td').data('voornaam');
                let roepnaam = $(this).closest('td').data('roepnaam');
                let email = $(this).closest('td').data('email');
                let straat = $(this).closest('td').data('straat');
                let huisnummer = $(this).closest('td').data('huisnummer');
                let postcode = $(this).closest('td').data('postcode');
                let telefoon = $(this).closest('td').data('telefoon');
                let rijks = $(this).closest('td').data('rijksregisternummer');
                let geboortedatum = $(this).closest('td').data('geboortedatum');
                // Update the modal
                $('.modal-title').text(`Edit ${voornaam} ${naam}`);
                $('form').attr('action', `/admin/verantwoordelijke/${id}`);

                $('#naam').val(naam);
                $('#voornaam').val(voornaam);
                $('#roepnaam').val(roepnaam);
                $('#email').val(email);
                $('#straat').val(straat);
                $('#huisnummer').val(huisnummer);
                $('#postcode').val(postcode);
                $('#telefoon').val(telefoon);
                $('#geboortedatum').val(geboortedatum);
                $('#rijksregisternummer').val(rijks);
                $('input[name="_method"]').val('put');
                // Show the modal
                $('#modal-verant').modal('show');
            });

            $('tbody').on('click', '.btn-delete', function () {
                // Get data attributes from td tag
                let id = $(this).closest('td').data('id');
                let naam = $(this).closest('td').data('naam');
                let voornaam = $(this).closest('td').data('voornaam');
                // Set some values for Noty
                let text = `<p>Delete de verantwoordelijke <b>${voornaam} ${naam}</b>?</p>`;
                let type = 'warning';
                let btnText = 'Delete Verantwoordelijke';
                let btnClass = 'btn-success';

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
                        Noty.button('Cancel', 'btn btn-secondary ml-2', function () {
                            modal.close();
                        })
                    ]
                }).show();
            });

            $('#modal-verant form').submit(function (e) {
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
                        $('#modal-verant').modal('hide');
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
                $('.modal-title').text(`Nieuwe verantwoordelijke`);
                $('form').attr('action', `/admin/verantwoordelijke`);
                $('#naam').val('');
                $('input[name="_method"]').val('post');
                // Show the modal
                $('#modal-verant').modal('show');
            });
        });

        //verantwoordelijke verwijderen
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

        //dropdown inladen
        function loadDropdown(){
            $.getJSON('getAllVerenigingen')
                .done(function (data) {
                    console.log('data', data);
                    $.each(data, function (key, value) {
                        $('#dropdown-verenigingen').append('<option value="'+ value.id + '">' + value.naam + '</option>');
                })
        })}

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
                               <td>${value.vereniginglid[0].naam}</td>
                               <td>${value.vereniginglid[0].voornaam}</td>
                               <td>${value.vereniginglid[0].email}</td>
                               <td>${value.vereniginglid[0].telefoon}</td>
                               <td>${value.vereniginglid[0].straat}  ${value.vereniginglid[0].huisnummer}  ${value.vereniginglid[0].postcode}</td>
                               <td data-id="${value.vereniginglid[0].id}"
                                   data-naam="${value.vereniginglid[0].naam}"
                                   data-voornaam="${value.vereniginglid[0].voornaam}"
                                   data-roepnaam="${value.vereniginglid[0].roepnaam}"
                                   data-email="${value.vereniginglid[0].email}"
                                   data-straat="${value.vereniginglid[0].straat}"
                                   data-huisnummer="${value.vereniginglid[0].huisnummer}"
                                   data-postcode="${value.vereniginglid[0].postcode}"
                                   data-geboortedatum="${value.vereniginglid[0].geboortedatum}"
                                   data-telefoon="${value.vereniginglid[0].telefoon}"
                                   data-rijksregisternummer="${value.vereniginglid[0].rijksregisternr}">
                                    <div class="btn-group btn-group-sm" >
                                        <button href="#!" class="btn btn-outline-success btn-edit" data-toggle="tooltip"  title="Edit ${value.vereniginglid[0].naam}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button href="#!" class="btn btn-outline-danger btn-delete" data-toggle="tooltip" title="Delete ${value.vereniginglid[0].naam}" >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                               </td>
                           </tr>`;
                            $('tbody').append(tr);
                        } else {
                            let tr = `<tr>
                               <td>${value.naam}</td>
                               <td>${value.vereniginglid[0].naam}</td>
                               <td>${value.vereniginglid[0].voornaam}</td>
                               <td>${value.vereniginglid[0].email}</td>
                               <td>${value.vereniginglid[0].telefoon}</td>
                               <td>${value.vereniginglid[0].straat}  ${value.vereniginglid[0].huisnummer}  ${value.vereniginglid[0].postcode}</td>
                               <td data-id="${value.vereniginglid[0].id}"
                                   data-naam="${value.vereniginglid[0].naam}"
                                   data-voornaam="${value.vereniginglid[0].voornaam}"
                                   data-roepnaam="${value.vereniginglid[0].roepnaam}"
                                   data-email="${value.vereniginglid[0].email}"
                                   data-straat="${value.vereniginglid[0].straat}"
                                   data-huisnummer="${value.vereniginglid[0].huisnummer}"
                                   data-postcode="${value.vereniginglid[0].postcode}"
                                   data-geboortedatum="${value.vereniginglid[0].geboortedatum}"
                                   data-telefoon="${value.vereniginglid[0].telefoon}"
                                   data-rijksregisternummer="${value.vereniginglid[0].rijksregisternr}">
                                    <div class="btn-group btn-group-sm" >
                                        <button href="#!" class="btn btn-outline-success btn-edit" data-toggle="tooltip"  title="Edit ${value.vereniginglid[0].naam}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button href="#!" class="btn btn-outline-danger btn-delete" data-toggle="tooltip" title="Delete ${value.vereniginglid[0].naam}" >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                               </td>
                           </tr><tr>
                               <td>${value.naam}</td>
                               <td>${value.vereniginglid[1].naam}</td>
                               <td>${value.vereniginglid[1].voornaam}</td>
                               <td>${value.vereniginglid[1].email}</td>
                               <td>${value.vereniginglid[1].telefoon}</td>
                               <td>${value.vereniginglid[1].straat}  ${value.vereniginglid[1].huisnummer}  ${value.vereniginglid[1].postcode}</td>
                               <td data-id="${value.vereniginglid[1].id}"
                                   data-naam="${value.vereniginglid[1].naam}"
                                   data-voornaam="${value.vereniginglid[1].voornaam}"
                                   data-roepnaam="${value.vereniginglid[1].roepnaam}"
                                   data-email="${value.vereniginglid[1].email}"
                                   data-straat="${value.vereniginglid[1].straat}"
                                   data-huisnummer="${value.vereniginglid[1].huisnummer}"
                                   data-postcode="${value.vereniginglid[1].postcode}"
                                   data-geboortedatum="${value.vereniginglid[1].geboortedatum}"
                                   data-telefoon="${value.vereniginglid[1].telefoon}"
                                   data-rijksregisternummer="${value.vereniginglid[1].rijksregisternr}">
                                    <div class="btn-group btn-group-sm" >
                                        <button href="#!" class="btn btn-outline-success btn-edit" data-toggle="tooltip"  title="Edit ${value.vereniginglid[1].naam}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button href="#!" class="btn btn-outline-danger btn-delete" data-toggle="tooltip" title="Delete ${value.vereniginglid[1].naam}" >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
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
