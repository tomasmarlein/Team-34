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

    <form method="get" action="#" id="searchForm">
        <div class="row">
            <div class="col-sm-4 mb-2">
                <label for="sort">Verenigingen: </label>
                <select class="form-control" name="sort" id="vereniging_id">
                    <option value="%" selected>Alle Verenigingen</option>
                    @foreach ($verenigingen as $vereniging)
                        <option value="{{$vereniging->id}}">{{ucfirst($vereniging->naam)}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3 mb-2">
                <label for="email">Filter naam:</label>
                <input type="email" class="form-control" name="email" id="naam"
                       value="{{ request()->email }}" placeholder="Naam of voornaam">
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
                <th>Finale CheckIn</th>
                <th>Finale Checkuit</th>
                <th>Acties</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tijdsregistraties as $registratie)
                <tr>
                <td>{{$registratie->id}}</td>
                <td>{{$volledigenaam = $registratie->gebruikerstijd->naam . " " . $registratie->gebruikerstijd->voornaam}}</td>
                <td>{{$registratie->verenigingTijd->naam}}</td>
                    @if ($registratie->checkIn != null)
                        <td>{{$registratie->checkIn}}</td>
                        @else
                        <td><i class="far fa-times-circle"></i></td>
                    @endif

                    @if ($registratie->checkUit != null)
                        <td>{{$registratie->checkUit}}</td>
                    @else
                        <td><i class="far fa-times-circle"></i></td>
                    @endif

                    @if ($registratie->manCheckIn != null)
                        <td>{{$registratie->manCheckIn}}</td>
                    @else
                        <td align="center"><i class="far fa-times-circle"></i></td>
                    @endif

                    @if ($registratie->manCheckUit != null)
                        <td>{{$registratie->manCheckUit}}</td>
                    @else
                        <td align="center"><i class="far fa-times-circle"></i></td>
                    @endif

                    @if ($registratie->adminCheckIn != null)
                        <td>{{$registratie->adminCheckIn}}</td>
                    @else
                        <td align="center"><i class="far fa-times-circle"></i></td>
                    @endif

                    @if ($registratie->adminCheckUit != null)
                        <td>{{$registratie->adminCheckIn}}</td>
                    @else
                        <td align="center"><i class="far fa-times-circle"></i></td>
                    @endif


                    @if($registratie->adminCheckIn != null)
                        <td>{{$registratie->adminCheckIn}}</td>
                    @elseif($registratie->manCheckIn != null)
                        <td>{{$registratie->manCheckIn}}</td>
                    @else
                        <td>{{$registratie->checkIn}}</td>
                    @endif

                    @if($registratie->adminCheckUit != null)
                        <td>{{$registratie->adminCheckUit}}</td>
                    @elseif($registratie->manCheckUit != null)
                        <td>{{$registratie->manCheckUit}}</td>
                    @else
                        <td>{{$registratie->checkUit}}</td>
                    @endif

                <td>
                    <form action="tijdsregistratie/{{$registratie->id}}" method="post">
                        @method('delete')
                        @csrf
                        <div class="btn-group btn-group-sm">
                            <a href="tijdsregistratie/{{ $registratie->id }}/edit" class="btn btn-outline-success"
                               data-toggle="tooltip"
                               title="Edit tijdsregistratie voor {{$volledigenaam}}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="submit" class="btn btn-outline-danger"
                                    data-toggle="tooltip"
                                    title="Delete {{ $volledigenaam }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </form>
                </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    </div>

@endsection




