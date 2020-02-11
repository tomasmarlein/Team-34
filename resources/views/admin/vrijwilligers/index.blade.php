@extends('layouts.template')

@section('title', 'Vrijwilligers')

@section('main')
    <h1>Vrijwilligers</h1>
    @include('shared.alert')


    <form action="{{url('admin/download')}}" method="get" >
        <button type="submit" class="btn btn-primary btn-lg btn-block">
            Download die shit
        </button>
    </form>
    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" class="form-control">
        <br>
        <button class="btn btn-success">Import User Data</button>
    </form>

    <form method="get" action="/admin/vrijwilligers" id="searchForm">
        <div class="row">
            <div class="col-sm-3 mb-2">
                <label for="naam">Filter Naam</label>
                <input type="text" class="form-control" name="naam" id="naam"
                       value="{{ request()->naam }}" placeholder="Filter Naam">
            </div>
            <div class="col-sm-3 mb-2">
                <label for="email">Filter Email</label>
                <input type="email" class="form-control" name="email" id="email"
                       value="{{ request()->email }}" placeholder="Filter Email">
            </div>
            <div class="col-sm-3 mb-2">
                <label for="sort">Sort by</label>
                <select class="form-control" name="sort" id="sort">
                    <option value="%" selected>Name (A => Z)</option>
                    <option value="%">Name (Z => A)</option>
                    <option value="%">Email (A => Z)</option>
                    <option value="%">Email (Z => A)</option>
                    <option value="%">Not Active</option>
                    <option value="%">Admin</option>
                </select>
            </div>
            <div class="col-sm-3 mb-2">
                <label>Voeg toe</label><br>
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
                        <th></th>
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
        $(function () {
            loadTable();

            $('tbody').on('click', '.btn-delete', function () {
                // Get data attributes from td tag
                let id = $(this).closest('td').data('id');
                let naam = $(this).closest('td').data('naam');
                let voornaam = $(this).closest('td').data('voornaam');
                // Set some values for Noty
                let text = `<p>Delete de vrijwilliger <b>${voornaam} ${naam}</b>?</p>`;
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

            $('tbody').on('click', '.btn-edit', function () {
                // Get data attributes from td tag
                let id = $(this).closest('td').data('id');
                let naam = $(this).closest('td').data('naam');
                let voornaam = $(this).closest('td').data('voornaam');
                let roepnaam = $(this).closest('td').data('roepnaam');
                let email = $(this).closest('td').data('email');
                let telefoon = $(this).closest('td').data('telefoon');
                let geboortedatum = $(this).closest('td').data('geboortedatum');
                // Update the modal
                $('.modal-title').text(`Edit ${voornaam} ${naam}`);
                $('form').attr('action', `/admin/vrijwilligers/${id}`);

                $('#name').val(naam);
                $('#voornaam').val(voornaam);
                $('#roepnaam').val(roepnaam);
                $('#email').val(email);
                $('#telefoon').val(telefoon);
                $('#geboortedatum').val(geboortedatum);

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
                        if(value.lid.length == 1){
                            var verenigingnaam = value.lid[0].naam;
                        }else{
                            var verenigingnaam = 'Geen vereniging';
                        }

                        if(value.telefoon == null) {
                            var telefoon = '/'
                        } else {
                            var telefoon = value.telefoon
                        }

                        if(value.geboortedatum == null) {
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
                    });
                })
                .fail(function (e) {
                    console.log('error', e);
                })
        }
    </script>
@endsection
