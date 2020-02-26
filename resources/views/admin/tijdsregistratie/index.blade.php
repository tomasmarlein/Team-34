@extends('layouts.templatesnoshade')
@section('title', 'Tijdsregistratie')
@section('css_after')
    <script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
    <style>
        th{
            min-width: 120px;
        }

        .download{
            float:right;
        }
    </style>
@endsection
@section('main')
    <div class="container">
        <h1>Tijdsregistratie</h1>
        <div class="download">
            <form style="text-align: right" action="{{url('admin/downloadTijd')}}" method="get" >
                <button data-toggle="tooltip" title="Exporteer alle tijdsregistraties" style="height: 45px; width:55px ;color: #0C225D; background-color: #FFCF5D; border-color: #FFCF5D" type="submit" class="btn btn-primary btn-lg btn-block">
                    <i class="fas fa-download"></i>
                </button>
            </form>
        </div>



        <div class="table-responsive">
            <table id="mytable" class="table table-hover">
                <thead class="shadow">
                <tr>
                    <th>Naam</th>
                    <th>Vereniging</th>
                    <th>CheckIn</th>
                    <th>CheckUit</th>
                    <th>Man-CheckIn</th>
                    <th>Man-CheckUit</th>
                    <th>AdminCheckin</th>
                    <th>AdminCheckuit</th>
                    <th>Finale CheckIn</th>
                    <th>Finale Checkuit</th>
                    <th >Acties</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        @include('admin.tijdsregistratie.modal')
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
                        let text = `<p>Verwijder de trijdergeistraat <b>${naam}</b>?</p>`;

                        let  btnText = `Verwijder tijdsregistratie`;
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
                        let voornaam = $(this).closest('td').data('voornaam');
                        let vereniging = $(this).closest('td').data('vereniging');
                        let checkin = $(this).closest('td').data('checkIn');
                        let checkUit = $(this).closest('td').data('checkUit');
                        let manCheckIn = $(this).closest('td').data('manCheckIn');
                        let manCheckUit = $(this).closest('td').data('manCheckUit');
                        // Update the modal
                        $('.modal-title').text(`Edit ${naam} ${voornaam}`);
                        $('form').attr('action', `/admin/tijdsregistratie/${id}`);

                        $('#naam').val(naam);
                        $('#voornaam').val(voornaam);
                        $('#vereniging').val(vereniging);
                        $('#checkIn').val(checkin);
                        $('#checkUit').val(checkUit);
                        $('#manCheckIn').val(manCheckIn);
                        $('#manCheckUit').val(manCheckUit);

                        $('input[name="_method"]').val('put');

                        // Show the modal
                        $('#modal-tijdsregistratie').modal('show');
                    });

                    $('#modal-tijdsregistratie form').submit(function (e) {
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
                                $('#modal-tijdsregistratie').modal('hide');
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
                        $('.modal-title').text(`Nieuw Tijdsregiestratie`);

                        $('form').attr('action', `/admin/Tijdsregiestratie`);

                        $('#checkIn').val('');
                        $('#checkUit').val('');
                        $('#manCheckIn').val('');
                        $('#manCheckUit').val('');
                        $('#adminCheckIn').val('');
                        $('#adminCheckIn').val('');
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
                    $.post(`/admin/Tijdsregiestratie/${id}`, pars, 'json')
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


                    $.getJSON('qryTijdsregistratie')
                        .done(function (data) {
                            // Clear tbody tag

                            console.log(data);
                            $('tbody').empty();
                            // Loop over each item in the array
                                $.each(data, function (key, value) {

                                    a = value.checkIn;
                                    b = value.checkUit;
                                    c = value.manCheckIn;
                                    d = value.manCheckUit
                                if(value.checkIn != null && a != '0000-00-00 00:00:00'){
                                    var checkIn = value.checkIn
                                } else {
                                    var checkIn = "<i class='far fa-times-circle'></i>";
                                }

                                if(value.checkUit != null && b != '0000-00-00 00:00:00'){
                                    var checkUit = value.checkUit
                                } else {
                                    var checkUit = "<i class='far fa-times-circle'></i>";
                                }

                                if(value.manCheckIn != null && c != '0000-00-00 00:00:00'){
                                    var manCheckIn = value.manCheckIn;
                                } else {
                                    var manCheckIn = "<i class='far fa-times-circle'></i>";
                                }

                                if(value.manCheckUit != null && d != '0000-00-00 00:00:00'){
                                    var manCheckUit = value.manCheckUit;
                                } else {
                                    var manCheckUit = "<i class='far fa-times-circle'></i>";
                                }

                                if(value.adminCheckIn != null){
                                    var adminCheckIn = value.adminCheckIn;
                                } else {
                                    var adminCheckIn = "<i class='far fa-times-circle'></i>";
                                }

                                if(value.adminCheckUit != null){
                                    var adminCheckUit = value.adminCheckUit;
                                } else {
                                    var adminCheckUit = "<i class='far fa-times-circle'></i>";
                                }

                                let tr = `<tr>
                               <td>${value.gebruikerstijd.naam} ${value.gebruikerstijd.voornaam}</td>
                               <td>${value.vereniging_tijd.naam}</td>
                               <td align="center">${checkIn}</td>
                               <td align="center">${checkUit}</td>
                               <td align="center">${manCheckIn}</td>
                               <td align="center">${manCheckUit}</td>
                               <td align="center">${adminCheckIn}</td>
                               <td align="center">${adminCheckUit}</td>
                               <td align="center">${value.checkIn}</td>
                               <td align="center">${value.checkUit}</td>


                               <td data-id="${value.id}".
                                   data-naam="${value.gebruikerstijd.naam}"
                                   data-voornaam="${value.gebruikerstijd.voornaam}"
                                   data-vereniging="${value.vereniging_tijd.naam}"
                                   data-checkIn="${value.checkIn}"
                                   data-checkUit="${value.checkUit}"
                                   data-manCheckIn="${value.manCheckIn}"
                                   data-manCheckUit="${value.manCheckUit}"
                                   data-adminCheckIn="${value.adminCheckIn}"
                                   data-adminCheckUit="${value.adminCheckUit}"
                                    align="center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="#!" class="btn btn-outline-success btn-edit" data-toggle="tooltip" title="Wijzig ${value.gebruikerstijd.naam} ${value.gebruikerstijd.voornaam}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#!" class="btn btn-outline-danger btn-delete" data-toggle="tooltip" title="Verwijder ${value.gebruikerstijd.naam} ${value.gebruikerstijd.voornaam}">
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

@stop




