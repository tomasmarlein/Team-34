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
               <th>#</th>
               <th>Startdatum</th>
               <th>Einddatum</th>
               <th>Naam</th>
               <th>Actief</th>
               <th></th>
           </tr>
           </thead>
           <tbody>

           </tbody>
       </table>
   </div>


@endsection


