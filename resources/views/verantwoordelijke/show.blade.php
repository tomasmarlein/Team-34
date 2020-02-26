@extends('layouts.template')

@section('title', 'Leden')

@section('main')

    <h1 style="float: left">{{$vereniging->naam}}</h1>
    <div style="float:right">
        <h4>Bewerken :  <i style="color: #38c172" class="fas fa-edit"></i></h4>
        <h4>Verwijderen :  <i style="color: #e3342f" class="fas fa-trash"></i></h4>
        <h4>Niet Ingevuld :  <i style="color: darkred" class="fas fa-question-circle"></i></h4>


    </div>
    <div class="table-responsive">
        <table class="table">
            <a href="#!" id="btn-create" style="width: 100%" class="btn btn-outline-success" data-toggle="tooltip" title="lid toevoegen">
               Lid Toevoegen
            </a>
            <thead>
            <tr>
                <th>Naam</th>
                <th>Achternaam</th>
                <th>Rijksregister</th>
                <th>Geboortedatum</th>
                <th>Telefoon</th>
                <th>Email</th>
                <th style="text-align: center">Opmerking</th>
                <th>Acties</th>
            </tr>
            </thead>
            <tbody>
            @foreach($vereniging->vereniginglid as $item)
                <tr>
                    <td>{{$item->voornaam}}</td>
                    <td>{{$item->naam}}</td>
                    @if($item->rijksregisternr == null)
                        <td style="text-align: center;color: darkred"><i data-toggle="tooltip" title="Nog niet ingevuld" class="fas fa-question-circle"></i></td>
                    @else
                        <td style="text-align: center">{{$item->rijksregisternr}}</td>
                    @endif

                    @if($item->geboortedatum == null)
                        <td style="text-align: center;color: darkred"><i data-toggle="tooltip" title="Nog niet ingevuld" class="fas fa-question-circle"></i></td>
                    @else
                        <td style="text-align: center">{{$item->geboortedatum}}</td>
                    @endif
                    @if($item->telefoon == null)
                        <td style="text-align: center;color: darkred"><i data-toggle="tooltip" title="Nog niet ingevuld" class="fas fa-question-circle"></i></td>
                    @else
                        <td style="text-align: center">{{$item->telefoon}}</td>
                    @endif
                    @if($item->email == null or $item->email == "n/a")
                        <td style="text-align: center;color: darkred"><i data-toggle="tooltip" title="Nog niet ingevuld" class="fas fa-question-circle"></i></td>
                    @else
                        <td style="text-align: center">{{$item->email}}</td>
                    @endif
                    @if($item->opmerking == null)
                        <td style="text-align: center"><i class="fas fa-comment-slash"></i></td>
                    @else
                        <td style="text-align: center"><a href=""><i class="fas fa-comment"  data-toggle="tooltip" title="{{$item->opmerking}}"></i></a></td>
                    @endif

                    <td data-id="{{$item->id}}"
                        data-naam="{{$item->naam}}"
                        data-voornaam="{{$item->voornaam}}"
                        data-telefoon="{{$item->telefoon}}"
                        data-email="{{$item->email}}"
                        data-geboortedatum="{{$item->geboortedatum}}"
                        data-rijksregisternr="{{$item->rijksregisternr}}"
                        data-opmerking="{{$item->opmerking}}">

                        <div class="btn-group btn-group-sm">
                            <a href="#!" class="btn btn-outline-success btn-edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#!" class="btn btn-outline-danger btn-delete" data-toggle="tooltip" title="Verwijder {{$item->voornaam}}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @include('verantwoordelijke.modal')

@endsection



@section('script_after')
<script>
    $('tbody').on('click', '.btn-delete', function () {
        // Get data attributes from td tag
        let id = $(this).closest('td').data('id');
        let naam = $(this).closest('td').data('naam');
        let voornaam = $(this).closest('td').data('voornaam');
        // Set some values for Noty
        let text = `<p>Verwijder de vrijwilliger <b>${voornaam} ${naam}</b>?</p>`;
        let type = 'warning';
        let btnText = 'Verwijder vrijwilliger';
        let btnClass = 'btn-danger';

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
                Noty.button('Annuleer', 'btn btn-secondary ml-2', function () {
                    modal.close();
                })
            ]
        }).show();
    });
    //
    $('tbody').on('click', '.btn-edit', function () {
        // Get data attributes from td tag
        let id = $(this).closest('td').data('id');
        let naam = $(this).closest('td').data('naam');
        let voornaam = $(this).closest('td').data('voornaam');
        let email = $(this).closest('td').data('email');
        let telefoon = $(this).closest('td').data('telefoon');
        let geboortedatum = $(this).closest('td').data('geboortedatum');
        let rijksregisternr = $(this).closest('td').data('rijksregisternr');
        let opmerking = $(this).closest('td').data('opmerking');
        // Update the modal
        $('.modal-title').text(`Wijzig ${voornaam} ${naam}`);
        $('form').attr('action', `/verantwoordelijke/verenigingen/${id}`);

        $('#naam').val(naam);
        $('#voornaam').val(voornaam);
        $('#email').val(email);
        $('#telefoon').val(telefoon);
        $('#geboortedatum').val(geboortedatum);
        $('#rijksregisternr').val(rijksregisternr);
        $('#opmerking').val(opmerking);

        $('input[name="_method"]').val('put');
        // Show the modal
        $('#modal-lid').modal('show');
    });


    $('#modal-lid form').submit(function (e) {
        // Don't submit the form
        e.preventDefault();
        // Get the action property (the URL to submit)
        let action = $(this).attr('action');
        // Serialize the form and send it as a parameter with the post
        let pars = $(this).serialize();
        console.log(pars + action);
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
                $('#modal-lid').modal('hide');
                location.reload();

            })
            .fail(function (e) {
                console.log('error', e);
                // // e.responseJSON.errors contains an array of all the validation errors
                // console.log('error message', e.responseJSON.errors);
                // // Loop over the e.responseJSON.errors array and create an ul list with all the error messages
                // let msg = '<ul>';
                // $.each(e.responseJSON.errors, function (key, value) {
                //     msg += `<li>${value}</li>`;
                // });
                // msg += '</ul>';
                // // Noty the errors
                // new Noty({
                //     type: 'error',
                //     text: msg
                // }).show();
            });
    });

    $('#btn-create').click(function () {
        // Update the modal
        $('.modal-title').text(`Nieuw Lid Toevoegen`);
        $('form').attr('action', `/verantwoordelijke/verenigingen`);
        $('#naam').val('');
        $('#voornaam').val('');
        $('#email').val('');
        $('#telefoon').val('');
        $('#geboortedatum').val('');
        $('#rijksregisternr').val('');
        $('#opmerking').val('');
        $('input[name="_method"]').val('post');
        // Show the modal
        $('#modal-lid').modal('show');
    });


    // Delete a genre
    function deleteGebruiker(id) {
        // Delete the genre from the database
        let pars = {
            '_token': '{{ csrf_token() }}',
            '_method': 'delete'
        };
        $.post(`/verantwoordelijke/verenigingen/${id}`, pars, 'json')
            .done(function (data) {
                console.log('data', data);
                // Show toast
                new Noty({
                    type: data.type,
                    text: data.text
                }).show();
                // Rebuild the table
                // loadTable();
                location.reload();
            })
            .fail(function (e) {
                console.log('error', e);
            });
    }

</script>

@stop


