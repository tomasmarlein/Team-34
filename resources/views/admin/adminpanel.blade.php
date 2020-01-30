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

        #count {
            border-radius: 75%;
            align-content: center;
            position: absolute;
            font-size: 22pt;


            top: -15px;
            right: -15px;
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

        .btn-group {
            margin-bottom: 5%;
        }


    </style>
@endsection

@section('main')


    <div style="background-color:#443339 ">
        <div class="jumbotron">

<div class="row">

    <div class="col-8"> <h1 class="display-4">Adminpanel</h1>

        </div>
    <form class="col-4">
        <div class="form-group" >
            <select class="form-control">
                @foreach($evenementen as $evenement)
                    <option value="{{ $evenement->id }}" class="dropdown-item" href="#">{{ $evenement->naam }}</option>
                @endforeach
                <option value="%" class="dropdown-item" href="#">alle evenementen</option>
            </select>

        </div>
    </form>
</div>
            <p class="lead">Welkom {{ Auth::user()->naam }} in het tijdsregistratiesysteem van Keizer Karel Olen</p>
            <hr class="my-4">
            <p>Beheer hier evenementen, verenigingen, vrijwilligers en de tijdsregistratie voor evenementen van Keizer
                Karel Olen.</p>


                <div id="knoppen">
                    @if(auth()->user()->rolID=1)

                        <div class="card-columns" >
                            <a href="/admin/evenementen">
                                <div class="card" style="margin-top: 2rem">
                                    <img class="card-img-top" src="/assets/adminpanel/evenementen.jfif"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Evenementen</h5>
                                        <p class="card-text">Beheer evenementen</p>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <a href="/admin/kernleden">
                                <div class="card" style="margin-top: 2rem">
                                    <img class="card-img-top" src="/assets/adminpanel/verantwoordelijke.jfif"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Kernleden</h5>
                                        <p class="card-text">Kernleden zijn gebruikers aangesteld door admins om
                                            verenigigen, verantwoordelijke en gebruikers te beheren
                                            het tijdsregistraties kunnen beheren</p>
                                    </div>
                                </div>
                            </a>
                            <a href="/inaanvraag">

                                <div class="card" style="margin-top: 2rem">
                                    <span id="count" class="badge badge-primary pull-left shadow-lg" style="margin-top: 0.25rem;margin-right:0.25rem;  z-index: 1 "></span>
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


                        <div class="card-columns">
                            <a href="#">
                                <div class="card">
                                    <img class="card-img-top" src="assets/adminpanel/tshirt.jfif"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">T-shirts</h5>
                                        <p class="card-text">Beheer de thsirts.</p>
                                    </div>
                                </div>
                            </a>
                            <a href="#n">
                                <div class="card">
                                    <img class="card-img-top" src="assets/adminpanel/lunch.jfif"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Lunchpakketen</h5>
                                        <p class="card-text">Verenigenen die meeerken aan evenementen van Keizer karel
                                            Olen</p>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <a href="/admin/vrijwilligers">
                                <div class="card">
                                    <img class="card-img-top" src="assets/adminpanel/time.jfif"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">Tijdsregistratie dashboard</h5>
                                        <p class="card-text">This card has supporting text below as a natural lead-in to
                                            additional content.</p>
                                    </div>
                                </div>
                            </a>

                        </div>

                    @endif



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




