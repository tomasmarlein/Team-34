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

        @if(auth()->user()->rolID=1)
        <div class="card-deck">
            <div class="card">
                <img class="card-img-top" src="/assets/adminpanel/evenementen.jfif" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Evenementen</h5>
                    <p class="card-text">Beheer evenementen</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="assets/adminpanel/kernleden.jfif" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Verantwoordelijke</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="/assets/adminpanel/verantwoordelijke.jfif" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Kernleden</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
            <div class="card">
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">In aanvraag</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                </div>
            </div>
        </div>

        @endif




        @if(auth()->user()->rolID=1)
            <a class="btn btn-primary btn-lg" href="/admin/evenementen" role="button">Evenementen</a>
            <a class="btn btn-primary btn-lg" href="/admin/verantwoordelijke" role="button">verantwoordelijke</a>
            <a class="btn btn-primary btn-lg" href="#" role="button">Kernleden</a>
            <a class="btn btn-primary btn-lg" href="/" role="button">In aanvraag</a>
        @endif
            <a class="btn btn-primary btn-lg" href="/admin/verenigingen" role="button">Verenigingen</a>
            <a class="btn btn-primary btn-lg" href="/admin/vrijwilligers" role="button">Vrijwilligers</a>

    </div>
</div>
@endsection

