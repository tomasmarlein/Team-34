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


        <div class="row">
            <div class="col-sm-6 mb-2">
                <input class="form-control" id="myInput" type="text" placeholder="Zoek op naam, email, ...">
            </div>
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
                <tbody id="myTable">

                </tbody>
            </table>
        </div>
        @include('admin.tijdsregistratie.modal')
        @endsection
        @section('script_after')
            <script>
                $(function () {
                    // search table
                    $("#myInput").on("keyup", function() {
                        var value = $(this).val().toLowerCase();
                        $("#myTable tr").filter(function() {
                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });
                    });



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
                        let checkin = $(this).closest('td').data('checkin');
                        let checkUit = $(this).closest('td').data('checkuit');
                        let manCheckIn = $(this).closest('td').data('mancheckin');
                        let manCheckUit = $(this).closest('td').data('mancheckuit');
                        let adminCheckIn = $(this).closest('td').data('admincheckin');
                        let adminCheckUit = $(this).closest('td').data('admincheckuit');
                        // Update the modal
                        $('.modal-title').text(`Edit ${naam} ${voornaam}`);
                        $('form').attr('action', `/admin/tijdsregistratie/${id}`);

                        $('#naam').val(naam);
                        $('#voornaam').val(voornaam);
                        $('#vereniging').val(vereniging);

                        if(checkin != null){
                            $('#checkIn').val(checkin);
                        } else {
                            $('#checkIn').val('Geen check in');
                        }

                        if(checkUit != null){
                            $('#checkUit').val(checkUit);
                        } else {
                            $('#checkUit').val('Geen check uit');
                        }

                        if(manCheckIn != null){
                            $('#manCheckIn').val(manCheckIn);
                        } else{
                            $('#manCheckIn').val('Geen manuele check in');
                        }

                        if(manCheckUit != null){
                            $('#manCheckUit').val(manCheckUit);
                        } else {
                            $('#manCheckUit').val('Geen manuele check uit');
                        }

                        $('#adminCheckIn').val(adminCheckIn);
                        $('#adminCheckUit').val(adminCheckUit)

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

                                adIn = value.adminCheckIn;
                                manIn = value.manCheckIn;
                                chIn = value.checkIn;

                                if(value.adminCheckIn != null && adIn != '0000-00-00 00:00:00'){
                                    var finaleIn = value.adminCheckIn;
                                } else {
                                    if(value.manCheckIn != null && manIn != '0000-00-00 00:00:00'){
                                        var finaleIn = value.manCheckIn;
                                    } else {
                                        if(chIn != null && chIn != '0000-00-00 00:00:00'){
                                            var finaleIn = value.checkIn;
                                        } else {
                                            var finaleIn = 'Geen check in tijd';
                                        }
                                    }
                                }

                                adUit = value.adminCheckUit;
                                manUit = value.manCheckUit;
                                chUit = value.checkUit;

                                if(value.adminCheckUit != null && adUit != '0000-00-00 00:00:00'){
                                    var finaleUit = value.adminCheckUit;
                                } else {
                                    if(value.manCheckUit != null && manUit != '0000-00-00 00:00:00'){
                                        var finaleUit = value.manCheckUit;
                                    } else {
                                        if(chUit != null && chUit != '0000-00-00 00:00:00'){
                                            var finaleUit = value.checkUit;
                                        } else {
                                            var finaleUit = 'Geen check uit tijd';
                                        }
                                    }
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
                               <td align="center">${finaleIn}</td>
                               <td align="center">${finaleUit}</td>


                               <td data-id="${value.id}"
                                   data-naam="${value.gebruikerstijd.naam}"
                                   data-voornaam="${value.gebruikerstijd.voornaam}"
                                   data-vereniging="${value.vereniging_tijd.naam}"
                                   data-checkin="${value.checkIn}"
                                   data-checkuit="${value.checkUit}"
                                   data-mancheckin="${value.manCheckIn}"
                                   data-mancheckuit="${value.manCheckUit}"
                                   data-admincheckin="${value.adminCheckIn}"
                                   data-admincheckuit="${value.adminCheckUit}"
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




