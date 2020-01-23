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
                <div class="col-sm-2 mb-2">
                    <p>Nieuwe vereniging</p>
                    <button href="#!" class="btn btn-outline-success" id="btn-create">Nieuwe vereniging</button>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Telefoon</th>
                    <th>Rekeningnr</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script_after')
    <script>
        $(function () {
            loadTable();
        });

        //tabel inladen
        function loadTable() {
            $.getJSON('/admin/verantwoordelijke/qryVerantwoordelijke')
                .done(function (data) {
                    console.log('data', data);
                    // Clear tbody tag
                    $('tbody').empty();
                    // Loop over each item in the array
                    $.each(data, function (key, value) {
                        let tr = `<tr>
                               <td>${value.id}</td>
                               <td>${value.name}</td>
                               <td>${value.Email}</td>
                               <td>${value.telefoon}</td>
                               <td>${value.Rekeningnr}</td>
                               <td data-id="${value.id}"
                                   data-email="${value.email}"
                                   data-name="${value.name}">
                                    <div class="btn-group btn-group-sm" >
                                        <button href="#!" class="btn btn-outline-success btn-edit" data-toggle="tooltip"  title="Edit ${value.name}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button href="#!" class="btn btn-outline-danger btn-delete" data-toggle="tooltip" title="Delete ${value.name}" ${disabled} >
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
                })

        }
    </script>
    @endsection
