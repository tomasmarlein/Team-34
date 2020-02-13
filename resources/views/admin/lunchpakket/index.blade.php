@extends('layouts.template')
@section('title', 'Lunchpakket')
@section('css_after')
    <style>

        .download{
            position: absolute;
            right: 13.7%;
            top: 11%;
        }
    </style>
@endsection
@section('main')
<h1>Lunchpakketen</h1>

    <div class="download">
        <form style="text-align: right" action="{{url('#')}}" method="get" >
            <button data-toggle="tooltip" title="Exporteer overzicht Lunchpakketen" style="height: 45px; width:55px ;color: #0C225D; background-color: #FFCF5D; border-color: #FFCF5D" type="submit" class="btn btn-primary btn-lg btn-block">
                <i class="fas fa-download"></i>
            </button>
        </form>
    </div>
    <br>
    <form method="get" action="#" id="searchForm">
        <div class="row">

            <div class="col-sm-3 mb-2">
                <label for="email">Zoek op naam: </label>
                <input type="email" class="form-control" name="email" id="email"
                       value="{{ request()->email }}" placeholder="E-mail adres">
            </div>
            <div class="col-sm-6 mb-2">
                <label for="sort">Zoek op Vereniging </label>
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
                <th>Vereniging</th>
                <th>Naam</th>

                <th>Acties</th>
            </tr>
            </thead>
            <tbody>
            @foreach($lunchpakket as $lunchpakket)
                <tr>
                    <td>{{ $lunchpakket->id }}</td>
                    <td>V naam{{--{{ $lunchpakket->lid->naam}}--}}</td>
                    <td>{{ $lunchpakket->naam }}</td>
                    <td>


                            @csrf
                            <div class="btn-group btn-group-sm">

                                <button type="submit" class="btn btn-outline-danger"
                                        data-toggle="tooltip"
                                        title="Verwijder lunchpakket voor {{ $lunchpakket->naam }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                    </td>
                </tr>

                @endforeach

            </tbody>
        </table>
    </div>
    @include('admin.tijdsregistratie.modal')
@endsection
@section('script_after')
    <script>
        $(function () {
            $('tbody').on('click', '.btn-outline-danger', function () {
                // Get data attributes from td tag
/*                let id = $(this).closest('td').data('id');
                let name = $(this).closest('td').data('name');
                let records = $(this).closest('td').data('records');*/
                // Set some values for Noty
                let text = `<p>Opgelet u gaat het lunchpakket voor de gebruiker verwijderen bent u zeker dat u dit wilt doen?</p>`;
                let type = 'warning';
                let btnText = 'Verwijder lunchpakket';
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
                            deleteGenre(id);
                            modal.close();
                        }),
                        Noty.button('Cancel', 'btn btn-secondary ml-2', function () {
                            modal.close();
                        })
                    ]
                }).show();
            });
            });

        });
    </script>
@stop




