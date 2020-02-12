@extends('layouts.template')

@section('title', 'Verenigingen')

@section('main')
    <h1>Aangevraagde Verenigingen</h1>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Status</th>
                <th>Naam</th>
                <th>Hoofdverantwoordelijke</th>
                <th>Rekeningnummer</th>
                <th>BTW Nummer</th>
                <th>Adres</th>
                <th></th>
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
            $('tbody').on('click', '.btn-delete', function () {
                // Get data attributes from td tag
                let id = $(this).closest('td').data('id');
                let naam = $(this).closest('td').data('naam');
                // Set some values for Noty
                let text = `<p>Verwijder de niet goedgekeurde vereniging <b>${naam}</b>?</p>`;
                let btnText = `Verwijder vereniging`;
                let btnClass = 'btn-danger';
                let type = 'warning';
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


        });


        // Delete een vereniging
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
            $.getJSON('qryVerenigingenInAanvraag')
                .done(function (data) {
                    // Clear tbody tag
                    $('tbody').empty();
                    // Loop over each item in the array
                    $.each(data, function (key, value) {


                        if (value.inaanvraag == 1) {
                            var inaanvraag = "<i style='color: darkred' class=\"fas fa-minus-square danger\"></i>\n";

                            var buttonIcon = "<i class=\"fas fa-check-square danger\"></i>\n"
                        }

                        let tr = `<tr>
                               <td>${value.id}</td>
                               <td>${inaanvraag}</td>
                               <td>${value.naam}</td>
                               <td>${value.hoofdverantwoordelijke}</td>
                               <td>${value.rekeningnr}</td>
                               <td>${value.btwnr}</td>
                               <td>${value.straat} ${value.huisnummer} ${value.postcode} ${value.gemeente}</td>

                               <td data-id="${value.id}"
                                   data-inaanvraag="${value.inaanvraag}"
                                   data-naam="${value.naam}" >
                                    <div class="btn-group btn-group-sm">
                                        <a href="#!" class="btn btn-outline-danger btn-delete">
                                            <i class="fas fa-trash"></i>
                                        </a>

                                        <a href="approve/${value.id}" class="btn btn-outline-success btn-actief">
                                           ${buttonIcon}
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

