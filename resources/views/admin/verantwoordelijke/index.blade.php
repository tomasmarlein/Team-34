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

            $('tbody').on('click', '.btn-delete', function () {
                // Get data attributes from td tag
                let id = $(this).closest('td').data('id');
                let naam = $(this).closest('td').data('naam');
                let voornaam = $(this).closest('td').data('voornaam');
                // Set some values for Noty
                let text = `<p>Delete de verantwoordelijke <b>${voornaam} ${naam}</b>?</p>`;
                let type = 'warning';
                let btnText = 'Delete Vrijwilliger';
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
            $.getJSON('qryVerenigingen')
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

                        if (Array.isArray(value.lid) && value.lid.length){
                            var verenigingnaam = '<td>'  + value.lid[0].naam + '</td>'
                        }else{
                            var verenigingnaam = '<td> Geen vereniging </td>'
                        }

                        let tr = `<tr>
                               ${verenigingnaam}
                               <td>${value.naam}</td>
                               <td>${value.voornaam}</td>
                               <td>${value.email}</td>
                               <td>${value.telefoon}</td>
                               <td>${value.straat}  ${value.huisnummer}  ${value.postcode}</td>
                               <td data-id="${value.id}"
                                   data-email="${value.email}"
                                   data-naam="${value.naam}"
                                   data-voornaam="${value.voornaam}">
                                    <div class="btn-group btn-group-sm" >
                                        <button href="#!" class="btn btn-outline-success btn-edit" data-toggle="tooltip"  title="Edit ${value.naam}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button href="#!" class="btn btn-outline-danger btn-delete" data-toggle="tooltip" title="Delete ${value.naam}" >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                               </td>
                           </tr>`;
                        // Append row to tbody
                        $('tbody').append(tr);
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
