@extends('layouts.template')
@section('title', 'Tijdsregistratie')

@section('main')


    <form method="get" action="/admin/vrijwilligers" id="searchForm">
        <div class="row">

            <div class="col-sm-3 mb-2">
                <label for="email">Filter op e-mail adres: </label>
                <input type="email" class="form-control" name="email" id="email"
                       value="{{ request()->email }}" placeholder="E-mail adres">
            </div>
            <div class="col-sm-6 mb-2">
                <label for="sort">Sorteer op: </label>
                <select class="form-control" name="sort" id="sort">
                    <option value="%" selected>Naam (A => Z)</option>
                    <option value="%">Naam (Z => A)</option>
                    <option value="%">E-mail (A => Z)</option>
                    <option value="%">E-mail (Z => A)</option>
                    <option value="%">Niet actief</option>
                    <option value="%">Admin</option>
                </select>
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
                <th>CheckIn</th>
                <th>CheckUit</th>
                <th>Man-CheckIn</th>
                <th>Man-CheckUit</th>
                <th>AdminCheckin</th>
                <th>AdminCheckuit</th>
                <th>Acties</th>
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


            $('tbody').on('click', '.btn-edit', function () {
                // Get data attributes from td tag
                let id = $(this).closest('td').data('id');
                let naam = $(this).closest('td').data('naam');
                let voornaam = $(this).closest('td').data('voornaam');

                let volledigenaam = naam +  " " + voornaam;

                let vereniging = $(this).closest('td').data('vereniging');
                let checkIn = $(this).closest('td').data('checkIn');
                let checkUit = $(this).closest('td').data('checkUit');
                let manCheckIn = $(this).closest('td').data('manCheckIn');
                let manCheckUit = $(this).closest('td').data('manCheckUit');
                let adminCheckIn = $(this).closest('td').data('admCheckIn');
                let adminCheckUit = $(this).closest('td').data('admCheckUit');

                console.log(checkIn);



                // Update the modal

                $('.modal-title').text(`Edit tijdsregistratie voor ${voornaam} ${naam}`);
                $('form').attr('action', `/admin/tijdsregistratie/${id}`);

                $('#naam').val(naam);
                $('#voornaam').val(voornaam);
                $('#volledigenaam').val(volledigenaam);
                $('#vereniging').val(vereniging);
                $('#checkIn').val(checkIn);
                $('#checkUit').val(checkUit);
                $('#manCheckIn').val(manCheckIn);
                $('#manCheckUit').val(manCheckUit);
                $('#adminCheckIn').val(adminCheckIn);
                $('#adminCheckUit').val(adminCheckUit);

                $('input[name="_method"]').val('put');
                // Show the modal
                $('#modal-tijdsregistratie').modal('show');
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




        });





        // Load genres with AJAX
        function loadTable() {
            $.getJSON('/admin/qryTijdsregistratie')
                .done(function (data) {
                    console.log('data', data);
                    // Clear tbody tag
                    $('tbody').empty();
                    // Loop over each item in the array
                    $.each(data, function (key, value) {

                        if(value.manCheckIn != null){
                            var manueelIN = value.manCheckIn;
                        }else{
                            var manueelIN = "<i class=\"fas fa-times-circle\"></i>";
                        }
                        if(value.manCheckUit != null){
                            var manueelUit = value.manCheckUit;
                        }else{
                            var manueelUit = "<i class=\"fas fa-times-circle\"></i>";
                        }
                        if(value.adminCheckIn != null){
                            var adminIn = value.adminCheckIn;
                        }else{
                            var adminIn = "<i class=\"fas fa-times-circle\"></i>";
                        }
                        if(value.adminCheckUit != null){
                            var adminUit = value.adminCheckUit;
                        }else{
                            var adminUit = "<i class=\"fas fa-times-circle\"></i>";
                        }




                        let tr = `<tr>
                               <td>${value.id}</td>
                               <td>${value.gebruikerstijd.naam + " " + value.gebruikerstijd.voornaam} </td>
                               <td>${value.vereniging_tijd.naam}</td>
                               <td align="center">${value.checkIn} </td>
                               <td align="center">${value.checkUit} </td>
                               <td align="center">${manueelIN}</td>
                               <td align="center">${manueelUit}</td>
                               <td align="center">${adminIn}</td>
                               <td align="center">${adminUit}</td>


                               <td data-id="${value.id}"
                                   data-naam="${value.gebruikerstijd.naam}"
                                   data-voornaam="${value.gebruikerstijd.voornaam}"
                                   data-vereniging="${value.vereniging_tijd.naam}"
                                   data-checkIn ="${value.checkIn}"
                                   data-checkUit="${value.checkUit} "
                                   data-manCheckIn="${value.manCheckIn}"
                                   data-manCheckUit="${value.manCheckUit}"
                                   data-admCheckIn="${value.adminCheckIn}"
                                   data-admCheckUit="${value.adminCheckUit}"


                                    <div class="btn-group btn-group-sm">
                                        <a href="#!" class="btn btn-outline-success btn-edit" data-toggle="tooltip" title="Wijzig tijdsregistratie ${value.gebruikerstijd.naam} ${value.gebruikerstijd.voornaam}">
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
                })
        }
    </script>
@endsection



