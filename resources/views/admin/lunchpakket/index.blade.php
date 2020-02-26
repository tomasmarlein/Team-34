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
                    @foreach($lunchpakket->lid as $lid)
                        <td>{{ $lid->naam }}</td>
                        @endforeach
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




