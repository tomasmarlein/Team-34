@extends('layouts.template')
@section('title', 'Tshirt beheer')
@section('css_after')

@endsection
@section('main')
 <h1>Overzicht T-shirts</h1>


 <div class="row" style="text-align: right;">
     <div class="col-sm-12 mb-2">
         <a href="#!" class="btn btn-outline-success" id="btn-create">
             <i class="fas fa-plus-circle mr-1"></i>Beheer Tshirts
         </a>
     </div>
 </div>


    <div class="table-responsive">
        <table id="mytable" class="table table-hover">
            <thead class="shadow">
            <tr>
                <th>#</th>
                <th>Naam</th>
                <th>Vereniging</th>
                <th>Tshirt</th>
                <th>Acties</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
 @include('admin.tshirt.modal')
@endsection
@section('script_after')
    <script>
        $(function () {
            loadTable();
            loadDropdown();

            $('tbody').on('click', '.btn-edit', function () {
                // Get data attributes from td tag
                let id = $(this).closest('td').data('tshirtid');
                let naam = $(this).closest('td').data('naam');
                let voornaam = $(this).closest('td').data('voornaam');
                let vereniging = $(this).closest('td').data('vereniging');
                let maat = $(this).closest('td').data('tshirtmaat');
                let geslacht = $(this).closest('td').data('tshirtgeslacht');
                let aantal = $(this).closest('td').data('tshirtaantal');
                let type = $(this).closest('td').data('tshirttype');
                let gebruikerId = $(this).closest('td').data('id');
                // Update the modal
                $('.modal-title').text(`Edit tshirt voor ${voornaam} ${naam}`);
                $('form').attr('action', `/admin/tshirt/${id}`);

                if(maat === ''){
                    $('#tshirt_maat').val('0');
                } else{
                    $('#tshirt_maat').val(maat);
                }

                if(geslacht === ''){
                    $('#tshirt_geslacht').val('0');
                } else{
                    $('#tshirt_geslacht').val(geslacht);
                }

                if(aantal === ''){
                    $('#tshirt_aantal').val('0');
                } else{
                    $('#tshirt_aantal').val(aantal);
                }

                if(type === ''){
                    $('#dropdown-types').val('leeg');
                } else{
                    $('#dropdown-types').val(type);
                }

                $('#naam').val(naam);
                $('#voornaam').val(voornaam);
                $('#vereniging').val(vereniging);
                $('#gebruikerId').val(gebruikerId);


                $('input[name="_method"]').val('put');
                // Show the modal
                $('#modal-tshirt').modal('show');
            });

            $('#modal-tshirt form').submit(function (e) {
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
                        $('#modal-tshirt').modal('hide');
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
                $('form').attr('action', `/admin/tshirt`);
                $('#naam').val('');
                $('input[name="_method"]').val('post');
                // Show the modal
                $('#modal-tshirt').modal('show');
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

        //dropdown inladen
        function loadDropdown(){
            $.getJSON('qryTshirtTypes')
                .done(function (data) {
                    console.log('data', data);
                    $.each(data, function (key, value) {
                        $('#dropdown-types').append('<option value="'+ value.id + '">' + value.type + '</option>');
                    })
                })}

        // Load genres with AJAX
        function loadTable() {
            $.getJSON('/admin/qryTshirt')
                .done(function (data) {
                    console.log('data', data);
                    // Clear tbody tag
                    $('tbody').empty();
                    // Loop over each item in the array
                    $.each(data, function (key, value) {
                        if(value.lid.length != 0){
                            for(var i=0; i<value.lid.length; i++) {
                                var verenigingnaam = value.lid[i].naam;
                                if(value.tshirt.length != 0){
                                    for(var i=0; i<value.tshirt.length; i++){

                                        let tr = `<tr>
                                            <td>${value.id}</td>
                                            <td>${value.naam} ${value.voornaam}</td>
                                            <td>${verenigingnaam}</td>
                                            <td>${value.tshirt[i].maat} ${value.tshirt[i].geslacht} ${value.tshirt[i].tshirt_type.type} ${value.tshirt[i].aantal} stuks</td>


                                               <td data-tshirtid="${value.tshirt[i].id}"
                                                   data-id="${value.id}"
                                                   data-naam="${value.naam}"
                                                   data-voornaam="${value.voornaam}"
                                                   data-vereniging="${verenigingnaam}"
                                                   data-tshirtmaat="${value.tshirt[i].maat}"
                                                   data-tshirtgeslacht="${value.tshirt[i].geslacht}"
                                                   data-tshirtaantal="${value.tshirt[i].aantal}"
                                                   data-tshirttype="${value.tshirt[i].tshirt_type.id}">

                                                    <div class="btn-group btn-group-sm">
                                                        <a href="#!" class="btn btn-outline-success btn-edit" data-toggle="tooltip" title="Wijzig ${value.naam} ${value.voornaam}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                               </td>
                                           </tr>`;
                                        // Append row to tbody
                                        $('tbody').append(tr);
                                    }
                                } else {
                                    var verenigingnaam = value.lid[i].naam;

                                    let tr = `<tr>
                                            <td>${value.id}</td>
                                            <td>${value.naam} ${value.voornaam}</td>
                                            <td>${verenigingnaam}</td>
                                            <td>Geen tshirt</td>


                                               <td data-tshirtid=""
                                                   data-id="${value.id}"
                                                   data-naam="${value.naam}"
                                                   data-voornaam="${value.voornaam}"
                                                   data-vereniging="${verenigingnaam}"
                                                   data-tshirtmaat=""
                                                   data-tshirtgeslacht=""
                                                   data-tshirtaantal=""
                                                   data-tshirttype="">

                                                    <div class="btn-group btn-group-sm">
                                                        <a href="#!" class="btn btn-outline-success btn-edit" data-toggle="tooltip" title="Wijzig ${value.naam} ${value.voornaam}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                               </td>
                                           </tr>`;
                                    // Append row to tbody
                                    $('tbody').append(tr);
                                }

                            }
                        } else {
                            var verenigingnaam = 'Geen vereniging';
                            if(value.tshirt.length != 0){
                                for(var i=0; i<value.tshirt.length; i++){

                                    let tr = `<tr>
                                            <td>${value.id}</td>
                                            <td>${value.naam} ${value.voornaam}</td>
                                            <td>${verenigingnaam}</td>
                                            <td>${value.tshirt[i].maat} ${value.tshirt[i].geslacht} ${value.tshirt[i].tshirt_type.type} ${value.tshirt[i].aantal} stuks</td>


                                               <td data-tshirtid="${value.tshirt[i].id}"
                                                   data-id="${value.id}"
                                                   data-naam="${value.naam}"
                                                   data-voornaam="${value.voornaam}"
                                                   data-vereniging="${verenigingnaam}"
                                                   data-tshirtmaat="${value.tshirt[i].maat}"
                                                   data-tshirtgeslacht="${value.tshirt[i].geslacht}"
                                                   data-tshirtaantal="${value.tshirt[i].aantal}"
                                                   data-tshirttype="${value.tshirt[i].tshirt_type.id}">

                                                    <div class="btn-group btn-group-sm">
                                                        <a href="#!" class="btn btn-outline-success btn-edit" data-toggle="tooltip" title="Wijzig ${value.naam} ${value.voornaam}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                               </td>
                                           </tr>`;
                                    // Append row to tbody
                                    $('tbody').append(tr);
                                }
                            } else {
                                var verenigingnaam = 'Geen vereniging';

                                let tr = `<tr>
                                            <td>${value.id}</td>
                                            <td>${value.naam} ${value.voornaam}</td>
                                            <td>${verenigingnaam}</td>
                                            <td>Geen tshirt</td>


                                               <td data-tshirtid=""
                                                   data-id="${value.id}"
                                                   data-naam="${value.naam}"
                                                   data-voornaam="${value.voornaam}"
                                                   data-vereniging="${verenigingnaam}"
                                                   data-tshirtmaat=""
                                                   data-tshirtgeslacht=""
                                                   data-tshirtaantal=""
                                                   data-tshirttype="">

                                                    <div class="btn-group btn-group-sm">
                                                        <a href="#!" class="btn btn-outline-success btn-edit" data-toggle="tooltip" title="Wijzig ${value.naam} ${value.voornaam}">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                               </td>
                                           </tr>`;
                                // Append row to tbody
                                $('tbody').append(tr);
                            }

                        }
                    });
                })
                .fail(function (e) {
                    console.log('error', e);
                })
        }
    </script>
@endsection



