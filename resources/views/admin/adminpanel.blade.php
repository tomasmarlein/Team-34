@extends('layouts.template')
@section('title', 'Tijdsregistratiesysteem')
@section('css_after')
    <style>
        body, html {

            background-image:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("assets/images/hero.jfif") ;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-color: #443339 ;
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
        .card-img-top{
            max-height: 222.23px;
        }
        .card-body{
            min-height: 164px;
        }
        .card:hover{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        a:link, a:visited{
            color: black;
            text-underline: none;
        }
        .btn-group{
            margin-bottom: 5%;
        }

    </style>
@endsection

@section('main')

<div>
    <div class="jumbotron">
        <h1 class="display-4">Adminpanel</h1>
        <p class="lead">Welkom {{ Auth::user()->naam }} in het tijdsregistratiesysteem van Keizer Karel Olen</p>
        <hr class="my-4">
        <p>Beheer hier evenementen, verenigingen, vrijwilligers en de tijdsregistratie voor evenementen van Keizer Karel Olen.</p>


        <div class="btn-group">
            <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                alle evenementen
            </button>


            <div class="dropdown-menu">
                @foreach($evenementen as $evenement)
                    <option value="{{ $evenement->id }}" class="dropdown-item" href="#">{{ $evenement->naam }}</option>
                @endforeach
                <div class="dropdown-divider"></div>
                    <option value="alle" class="dropdown-item" href="#">alle evenementen</option>
            </div>
        </div>

        <form>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Example select</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    @foreach($evenementen as $evenement)
                        <option value="{{ $evenement->id }}" class="dropdown-item" href="#">{{ $evenement->naam }}</option>
                    @endforeach
                        <option value="%" class="dropdown-item" href="#">alle evenementen</option>
                </select>
            </div>
        </form>

<div id="knoppen">
        @if(auth()->user()->rolID=1)

        <div class="card-columns">
            <a href="/admin/evenementen">
            <div class="card">
                <img class="card-img-top" src="/assets/adminpanel/evenementen.jfif" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Evenementen</h5>
                    <p class="card-text">Maak evenementen aan en beheer ze.</p>
                </div>
            </div>
            </a>
            <a href="/admin/verantwoordelijke">
            <div class="card">
                <img class="card-img-top" src="/assets/adminpanel/verantwoordelijke.jfif" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Kernleden</h5>
                    <p class="card-text">Kernleden zijn gebruikers aangesteld door admins om verenigigen, verantwoordelijke en gebruikers te beheren als ook gerbuik te kunnne maken van het tijdsregistratiesysteem</p>
                </div>
            </div>
                @endif
                @if(auth()->user()->rolID=1 OR auth()->user()->rolID=2 )
            </a>
            <a href="/inaanvraag">
            <div class="card">
                <img class="card-img-top" src="assets/adminpanel/aanvraag.jfif" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">In aanvraag</h5>
                    <p class="card-text">Indien een vereniging aanvraag doet om mee te helpen op evenementen van Kseizer Karel Olen zijn deze aanvragen hier te vinden.</p>
                </div>
            </div>
            </a>
        </div>
            <div class="card-columns">
                <a href="/admin/verantwoordelijke">
                <div class="card">
                    <img class="card-img-top" src="assets/adminpanel/kernleden.jfif" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Verantwoordelijke</h5>
                        <p class="card-text">Beheer de verantwoordelijke van verenigingen.</p>
                    </div>
                </div>
            </a>
                <a href="/admin/verenigingen">
                <div class="card">
                    <img class="card-img-top" src="assets/adminpanel/verenigigen.jfif" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Verenigingen</h5>
                        <p class="card-text">Verenigenen die meeerken aan evenementen van Keizer karel Olen</p>

                    </div>
                </div>
                </a>
                <a href="/admin/vrijwilligers">
                <div class="card">
                    <img class="card-img-top" src="assets/adminpanel/vrijwilliger.jfif" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Vrijwilligers</h5>
                        <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
                </a>

            </div>

        @endif
</div>
    </div>
</div>
@endsection




