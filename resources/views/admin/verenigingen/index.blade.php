@extends('layouts.template')

@section('title', 'Verenigingen')

@section('main')
    <h1>Genres</h1>
    <p>
        <a href="#!" class="btn btn-outline-success" id="btn-create">
            <i class="fas fa-plus-circle mr-1"></i>Maak nieuwe vereniging
        </a>
    </p>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Id</th>
                <th>Naam</th>
                <th>Rekeningnummer</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    @include('admin.verenigingen.modal', ['data' => $data])
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
                // Update the modal
                $('.modal-title').text(`Edit ${naam}`);
                $('form').attr('action', `/admin/verenigingen/${id}`);
                $('#name').val(naam);
                $('input[name="_method"]').val('put');
                // Show the modal
                $('#modal-genre').modal('show');
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
                $('#name').val('');
                $('input[name="_method"]').val('post');
                // Show the modal
                $('#modal-genre').modal('show');
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
            $.getJSON('/admin/verenigingen/qryVerenigingen')
                .done(function (data) {
                    console.log('data', data);
                    // Clear tbody tag
                    $('tbody').empty();
                    // Loop over each item in the array
                    $.each(data, function (key, value) {
                        let tr = `<tr>
                               <td>${value.id}</td>
                               <td>${value.naam}</td>
                               <td>${value.rekeningnr}</td>
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


@foreach($verenigingen as $vereniging)
    <tr>
        <td>{{ $vereniging->id }}</td>
        <td>{{ $vereniging->naam }}</td>
        <td>{{ $vereniging->rekeningnr }}</td>
        <td>
            <form action="/admin/verenigingen/{{ $vereniging->id }}" method="post" class="deleteForm">
                @method('delete')
                @csrf
                <div class="btn-group btn-group-sm">
                    <a href="/admin/verenigingen/{{ $vereniging->id }}/edit" class="btn btn-outline-success"
                       data-toggle="tooltip"
                       title="Edit {{ $vereniging->naam }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button type="submit" class="btn btn-outline-danger"
                            data-toggle="tooltip"
                            title="Delete {{ $vereniging->naam }}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </form>
        </td>
    </tr>
@endforeach
