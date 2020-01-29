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
               <th>roepnaam</th>
               <th>telefoon</th>
               <th>Opmerking</th>
               <th>lunchpakket</th>
               <th></th>
           </tr>
           </thead>
           <tbody>
           @foreach($vereniging->vereniginglid as $item)
               <tr>
                   <td>{{$item->voornaam}}</td>
                   <td>{{$item->naam}}</td>
                   @if($item->roepnaam == null)
                    <td>Geen roepnaam</td>
                   @else
                   <td>{{$item->roepnaam}}</td>
                   @endif
                   <td>{{$item->telefoon}}</td>
                   <td>{{$item->opemerking}}</td>
                   <td>{{$item->lunchpakket}}</td>
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


