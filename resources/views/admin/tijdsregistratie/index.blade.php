@extends('layouts.template')
@section('title', 'Tijdsregistratie')

@section('main')


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
            <div class="col-sm-6 mb-2">
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

@endsection
@section('script_after')
    <script>
        $(function () {
            loadTable();


            $('tbody').on('click', '.btn-edit', function () {
                // Get data attributes from td tag

                let naam = $(this).closest('td').data('naam');
                let voornaam = $(this).closest('td').data('voornaam');

                // Update the modal
                $('.modal-title').text(`Edit ${voornaam} ${naam}`);
                $('form').attr('action', `/admin/vrijwilligers/${id}`);

                $('#naam').val(naam);
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
                            var manueelIN = "<i class=\"far fa-window-close\"></i>";
                        }
                        if(value.manCheckUit != null){
                            var manueelUit = value.manCheckUit;
                        }else{
                            var manueelUit = "<i class=\"far fa-window-close\"></i>";
                        }
                        if(value.adminCheckIn != null){
                            var adminIn = value.adminCheckIn;
                        }else{
                            var adminIn = "<i class=\"far fa-window-close\"></i>";
                        }
                        if(value.adminCheckUit != null){
                            var adminUit = value.adminCheckUit;
                        }else{
                            var adminUit = "<i class=\"far fa-window-close\"></i>";
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
                                   data-checkIn =""
                                   data-checkUit=""
                                   data-checkIn=""
                                   data-



                                    <div class="btn-group btn-group-sm">
                                        <a href="#!" class="btn btn-outline-success btn-edit" data-toggle="tooltip" title="Wijzig ${value.gebruikerstijd.naam} ${value.gebruikerstijd.voornaam}">
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



