@extends('layouts.template')
@section('title', 'Tijdsregistratiesysteem')
@section('css_after')
    <style>
        body, html {
            height: 100%;
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("assets/images/hero.jfif");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            height: 100%;

             background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("assets/images/hero.jfif");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-color: #443339;
        }

        #count {
            border-radius: 75%;
            align-content: center;
            position: absolute;
            font-size: 22pt;


            top: -15px;
            right: -15px;
        }

        .hero-text {
            text-align: center;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
        }


        #footer {
            color: white;
        }

        #footer hr {
            height: 1px;
            background-color: #ccc;
            border: none;
        }

        main {
            min-height: 740px;
        }

        .hidden {
            display: none;
        }

        .card-img-top {
            max-height: 222.23px;
        }

        a:link, a:visited {
            color: black;
            text-underline: none;
        }

        .btn-group {
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
            <p>Beheer hier evenementen, verenigingen, vrijwilligers en de tijdsregistratie voor evenementen van Keizer
                Karel Olen.</p>


            <div class="btn-group">

                <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                    alle evenementen
                </button>
                <div class="dropdown-menu">
                    @foreach($evenementen as $evenement)
                        <option value="{{ $evenement->id }}" class="dropdown-item"
                                href="#">{{ $evenement->naam }}</option>
                    @endforeach
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">allemaal</a>
                </div>


                <div id="knoppen">
                    @if(auth()->user()->rolID=1)

                        <div class="card-columns">
                            <a href="/admin/evenementen">
                                <div class="card">
                                    <img class="card-img-top" src="/assets/adminpanel/evenementen.jfif"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Evenementen</h5>
                                        <p class="card-text">Beheer evenementen</p>
                                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <a href="/admin/verantwoordelijke">
                                <div class="card">
                                    <img class="card-img-top" src="/assets/adminpanel/verantwoordelijke.jfif"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Kernleden</h5>
                                        <p class="card-text">Kernleden zijn gebruikers aangesteld door admins om
                                            verenigigen, verantwoordelijke en gebruikers te beheren als ook gerbuik te
                                            kunnne maken van het tijdsregistratiesysteem</p>
                                    </div>
                                </div>
                            </a>
                            <a href="/inaanvraag">
                                <div class="card">
                                    <span id="count" class="badge badge-primary pull-left shadow-lg"></span>
                                    <img class="card-img-top" src="assets/adminpanel/aanvraag.jfif"
                                         alt="Card image cap">

                                    <div class="card-body">
                                        <h5 class="card-title">Verenigingen in aanvraag </h5>
                                        <p class="card-text">Indien een vereniging aanvraag doet om mee te helpen op
                                            evenementen van Keizer Karel Olen zijn deze aanvragen hier te vinden.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="card-columns">
                            <a href="/admin/evenementen">
                                <div class="card">
                                    <img class="card-img-top" src="/assets/adminpanel/evenementen.jfif"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Evenementen</h5>
                                        <p class="card-text">Beheer evenementen</p>
                                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <a href="/admin/verantwoordelijke">
                                <div class="card">
                                    <img class="card-img-top" src="/assets/adminpanel/verantwoordelijke.jfif"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Kernleden</h5>
                                        <p class="card-text">Kernleden zijn gebruikers aangesteld door admins om
                                            verenigigen, verantwoordelijke en gebruikers te beheren als ook gerbuik te
                                            kunnne maken van het tijdsregistratiesysteem</p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="card-columns">
                            <a href="/admin/verantwoordelijke">
                                <div class="card">
                                    <img class="card-img-top" src="assets/adminpanel/kernleden.jfif"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Verantwoordelijke</h5>
                                        <p class="card-text">Beheer de verantwoordelijke van verenigingen.</p>
                                    </div>
                                </div>
                            </a>
                            <a href="/admin/verenigingen">
                                <div class="card">
                                    <img class="card-img-top" src="assets/adminpanel/verenigigen.jfif"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Verenigingen</h5>
                                        <p class="card-text">Verenigenen die meeerken aan evenementen van Keizer karel
                                            Oler</p>
                                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <a href="/admin/vrijwilligers">
                                <div class="card">
                                    <img class="card-img-top" src="assets/adminpanel/vrijwilliger.jfif"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Vrijwilligers</h5>
                                        <p class="card-text">This card has supporting text below as a natural lead-in to
                                            additional content.</p>
                                    </div>
                                </div>
                            </a>

                        </div>

                    @endif

                </div>

            </div>
        </div>
        @endsection



        @section('script_after')
            <script>

                $(function () {
                    loadData();
                });


                function loadData() {
                    $.getJSON('qryVerenigingenInAanvraag')
                        .done(function (data) {
                            // Clear tag
                            $('#count').empty();
                            let i = 0;
                            // Loop over each item in the array
                            $.each(data, function (key, value) {
                                i++;
                            });
                            $('#count').append(i);

                            if (i == 0) {
                                $('#count').hide();
                            }


                        })
                        .fail(function (e) {
                            console.log('error', e);
                        })
                }
            </script>
@endsection




