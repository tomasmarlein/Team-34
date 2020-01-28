@extends('layouts.template')
@section('title', 'Tijdsregistratiesysteem')
@section('css_after')
    <style>
        body, html {
            height: 100%;
            background-image:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("assets/images/hero.jfif") ;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            height: 100%;
        }


        .hero-text {
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
        }


        #footer{
            color: white;
        }

        #footer hr{
            height: 1px;
            background-color: #ccc;
            border: none;
        }
        main{
            min-height: 740px;
        }
        .hidden{
            display: none;
        }
    </style>
@endsection

@section('main')

<div>
    <div class="jumbotron">
        <h1 class="display-4">Adminpanel</h1>
        <p class="lead">Welkom in het tijdsregistratiesysteem van Keizer Karel Olen</p>
        <hr class="my-4">
        <p>Beheer hier evenementen, verenigingen en vrijwilligers.</p>

<div id="knoppen">




</div>
        @if(auth()->user()->rolID=1)
            <a class="btn btn-primary btn-lg" href="/admin/evenementen" role="button">Evenementen</a>
            <a class="btn btn-primary btn-lg" href="/admin/verantwoordelijke" role="button">verantwoordelijke</a>
            <a class="btn btn-primary btn-lg" href="#" role="button">Kernleden</a>
            <a class="btn btn-primary btn-lg" href="/inaanvraag" role="button">In aanvraag</a>
        @endif
            <a class="btn btn-primary btn-lg" href="/admin/verenigingen" role="button">Verenigingen</a>
            <a class="btn btn-primary btn-lg" href="/admin/vrijwilligers" role="button">Vrijwilligers</a>

    </div>
</div>
@endsection




