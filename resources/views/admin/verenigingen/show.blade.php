@extends('layouts.template')

@section('title', $vereniging->naam)

@section('main')
   <h1 style="float:left">{{$vereniging->naam}}</h1>
   <div style="float: right">
   <a href="/tijdsregistratie">
   <div class="card text-black bg-light mb-3" style="max-width: 18rem;">
       <div class="card-header">Geschatte uren</div>
       <div class="card-body">
           <h1 class="card-title" style="" id="uren">Uren hierzo</h1>

       </div>
   </div>
   </a>
   </div>

   <div class="table-responsive">
       <table class="table">
           <thead>
           <tr>
               <th>naam</th>
               <th>achternaam</th>
               <th>telefoon</th>
               <th style="text-align: center">Opmerking</th>
               <th style="text-align: center">lunchpakket</th>
               <th>acties</th>
           </tr>
           </thead>
           <tbody>
           @foreach($vereniging->vereniginglid as $item)
               <tr>
                   <td>{{$item->voornaam}}</td>
                   <td>{{$item->naam}}</td>
                   <td>{{$item->telefoon}}</td>
                   @if($item->opmerking == null)
                    <td style="text-align: center"><i class="fas fa-comment-slash"></i></td>
                   @else
                       <td style="text-align: center"><a href=""><i class="fas fa-comment"  data-toggle="tooltip" title="{{$item->opmerking}}"></i></a></td>
                   @endif
                   @if($item->lunchpakket == 0)
                    <td style="text-align: center"><i style='color: darkred' class="fas fa-minus-square"></i></td>
                   @else
                   <td style="text-align: center"><i style='color: #2a9055' class="fas fa-check-square"></i></td>
                   @endif

                   <td data-id="{{$item->id}}"
                       data-naam="{{$item->naam}}"
                       data-voornaam=""
                       data-roepnaam="{{$item->naam}}"
                       data-email="${{$item->naam}}"
                       data-straat="${{$item->naam}}"
                       data-huisnummer="${{$item->naam}}"
                       data-postcode="${{$item->naam}}"
                       data-geboortedatum="${{$item->naam}}"
                       data-telefoon="{{$item->telefoon}}"
                       data-opmerking="{{$item->opmerking}}">

                       <div class="btn-group btn-group-sm">
                           <a href="#!" class="btn btn-outline-success btn-edit" data-toggle="tooltip" title="Wijzig {{$item->voornaam}} ">
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


@endsection

@section('script_after')
    <script>

    </script>

@stop


