@extends('layouts.template')
@section('title', 'Tijdsregistratiesysteem')
@section('css_after')
    <style>
        body, html {
            /*background-image:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("assets/images/hero.jfif");*/
            background-attachment: fixed;
            /*background-repeat: no-repeat;*/
            /*background-size: cover;*/
            /*background-position: center;*/
            background-color: lightgray;
        }

        #count {
            align-content: center;
            position: absolute;
            font-size: 15pt;
            top: 2%;
            right: 2%;
            animation: pulse-red 2s infinite;
        }

        @keyframes pulse-red {
            0% {
                transform: scale(0.85);
                box-shadow: 0 0 0 0 rgba(255, 82, 82, 0.7);
            }
            70% {
                transform: scale(1);
                box-shadow: 0 0 0 25px rgba(255, 82, 82, 0);
            }
            100% {
                transform: scale(0.85);
                box-shadow: 0 0 0 0 rgba(255, 82, 82, 0);
            }
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

        .btn-group {
            margin-bottom: 5%;
        }





    /*    card    */
        .card {
            position: relative;
            display: -webkit-box;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            flex-direction: column;
            width: 100%;
            background: white;
            color: currentColor;
            text-decoration: none;
            overflow: hidden;
            -webkit-transition-property: color;
            transition-property: color;
            -webkit-transition-delay: 0.15s;
            transition-delay: 0.15s;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 0px;
        }
        .card:hover {
            color: white;
            -webkit-transition-delay: 0;
            transition-delay: 0;
            text-underline: none;
        }


        .card, .card__image, .card__image::after, .card__author, .card__body, .card__foot, .card__border {
            -webkit-transition-duration: 0.4s;
            transition-duration: 0.4s;
            -webkit-transition-timing-function: cubic-bezier(0.51, 0.92, 0.24, 1);
            transition-timing-function: cubic-bezier(0.51, 0.92, 0.24, 1);
        }
        .card__head {
            position: relative;
            padding-top: 70%;
        }
        .card__author {
            position: absolute;
            padding: 2em;
            left: 0;
            bottom: 0;
            color: white;
            -webkit-transition-property: -webkit-transform;
            transition-property: -webkit-transform;
            transition-property: transform;
            transition-property: transform, -webkit-transform;
            -webkit-transition-delay: 0.15s;
            transition-delay: 0.15s;
        }
        .card.hover .card__author {
            -webkit-transition-delay: 0;
            transition-delay: 0;
        }
        .card__image {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-size: cover;
            background-position: center;
            -webkit-transform-origin: top center;
            transform-origin: top center;
            -webkit-transition-property: -webkit-transform;
            transition-property: -webkit-transform;
            transition-property: transform;
            transition-property: transform, -webkit-transform;
            -webkit-transition-delay: 0.15s;
            transition-delay: 0.15s;
        }
        .card__image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: .5;
            background: linear-gradient(30deg, rgba(26, 42, 99, 0.85), rgba(26, 42, 99, 0.5));
            -webkit-transition-property: opacity;
            transition-property: opacity;
            -webkit-transition-delay: 0.15s;
            transition-delay: 0.15s;
        }
        .card.hover .card__image {
            -webkit-transition-delay: 0;
            transition-delay: 0;
        }
        .card.hover .card__image::after {
            opacity: 1;
            -webkit-transition-delay: 0;
            transition-delay: 0;
        }
        .card__body {
            position: relative;
            padding: 2em;
            -webkit-transition-property: -webkit-transform;
            transition-property: -webkit-transform;
            transition-property: transform;
            transition-property: transform, -webkit-transform;
            -webkit-transition-delay: 0.15s;
            transition-delay: 0.15s;
            min-height: 220px;
        }
        .card.hover .card__body {
            -webkit-transition-delay: 0;
            transition-delay: 0;
        }
        .card__headline {
            font-weight: 400;
            margin: 0 0 .8em;
        }
        .card__text {
            line-height: 1.5;
            margin: 0;
            opacity: .8;
        }
        .card__foot {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            padding: 0 2em 2em;
            opacity: 0;
            -webkit-transition-property: opacity;
            transition-property: opacity;
        }
        .card.hover .card__foot {
            opacity: 1;
            -webkit-transition-delay: 0.15s;
            transition-delay: 0.15s;
        }
        .card__link {
            color: currentColor;
            text-decoration: none;
            border-bottom: 2px solid #b5272d;
        }
        .card__border {
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 6px;
            background: #b5272d;
            -webkit-transform: scaleY(0);
            transform: scaleY(0);
            -webkit-transition-property: -webkit-transform;
            transition-property: -webkit-transform;
            transition-property: transform;
            transition-property: transform, -webkit-transform;
        }
        .card.hover .card__border {
            -webkit-transform: none;
            transform: none;
            -webkit-transition-delay: 0.15s;
            transition-delay: 0.15s;
        }

        .author {
            display: -webkit-box;
            display: flex;
            -webkit-box-align: center;
            align-items: center;
        }
        .author__image {
             flex-shrink: 0;
             margin-right: 1em;
             width: 56px;
             height: 56px;
             border-radius: 0;
             overflow: hidden;
            position: relative;
         }

        .author__image i {
            text-align: center;
            font-size: 35px;
            margin-top: 20%;
        }

        .author__content {
            display: grid;
            grid-gap: .4em;
            font-size: .9em;
        }
        .author__header {
            margin: 0;
            font-weight: 600;
        }
        .author__subheader {
            margin: 0;
            opacity: .8;
        }

        .cardpadding{
            padding: 10px 10px;
        }


    </style>
@endsection

@section('main')


    <br><br>



            <div class="row">

                <div class="col-8"> <h1 class="display-4">Adminpaneel</h1>

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


            <p class="lead">Welkom {{ Auth::user()->naam }} in het tijdsregistratiesysteem van Keizer Karel Olen!</p>
            <hr class="my-4">
            <p>Beheer hier evenementen, kernleden, aanvragen, verantwoordelijken, verenigingen, vrijwilligers, T-shirts, lunchpakketten en tijdsregistraties voor evenementen van Keizer
                Karel Olen.</p>


                <div id="knoppen">
                    @if(auth()->user()->rolID=1)

                        <div class="row" style="margin-top: 2rem;">
                            <div class="col-lg-4 cardpadding">
                                <a href="/admin/evenementen" class="card">
                                    <div class="card__head">
                                        <div class="card__image" style="background-image: url('/assets/adminpanel/evenementen.jfif');"></div>
                                        <div class="card__author">
                                            <div class="author">
                                                <div class="author__image">
                                                    <i class="far fa-calendar-alt"></i>
                                                </div>
                                                <div class="author__content">
                                                    <p class="author__header">Evenementen</p>
                                                    <p class="author__subheader">Beheer evenementen</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card__body">
                                        <h2 class="card__headline">Evenementen</h2>
                                        <p class="card__text">Wijzig gegevens van evenementen, maak nieuwe evenementen aan en verwijder er.</p>
                                    </div>
                                    <div class="card__foot">
                                        <span class="card__link">Ga verder</span>
                                    </div>
                                    <div class="card__border"></div>
                                </a>
                            </div>

                            <div class="col-lg-4 cardpadding">
                                <a href="/admin/kernleden" class="card">
                                    <div class="card__head">
                                        <div class="card__image" style="background-image: url('/assets/adminpanel/verantwoordelijke.jfif');"></div>
                                        <div class="card__author">
                                            <div class="author">
                                                <div class="author__image">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                                <div class="author__content">
                                                    <p class="author__header">Kernleden</p>
                                                    <p class="author__subheader">Beheer kernleden</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card__body">
                                        <h2 class="card__headline">Kernleden</h2>
                                        <p class="card__text">Kernleden zijn gebruikers aangesteld door admins. Hier kan je de kernleden aanmaken, wijzigen en eventueel verwijderen.</p>
                                    </div>
                                    <div class="card__foot">
                                        <span class="card__link">Ga verder</span>
                                    </div>
                                    <div class="card__border"></div>
                                </a>
                            </div>

                            <div class="col-lg-4 cardpadding">
                                <a href="/inaanvraag" class="card">
                                    <span id="count" class="badge badge-danger shadow-lg" style="z-index: 999 "></span>
                                    <div class="card__head">
                                        <div class="card__image" style="background-image: url('assets/adminpanel/aanvraag.jfif');"></div>
                                        <div class="card__author">
                                            <div class="author">
                                                <div class="author__image">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </div>
                                                <div class="author__content">
                                                    <p class="author__header">Verenigingen in aanvraag</p>
                                                    <p class="author__subheader">Beheer verenigingen in aanvraag</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card__body">
                                        <h2 class="card__headline">Verenigingen in aanvraag</h2>
                                        <p class="card__text">Verenigingen waarvan de verantwoordelijke reeds een aanvraag heeft ingediend, kunnen hier worden goed- of afgekeurd.</p>
                                    </div>
                                    <div class="card__foot">
                                        <span class="card__link">Ga verder</span>
                                    </div>
                                    <div class="card__border"></div>
                                </a>
                            </div>

                            <div class="col-lg-4 cardpadding">
                                <a href="/admin/verantwoordelijke" class="card">
                                    <div class="card__head">
                                        <div class="card__image" style="background-image: url('assets/adminpanel/kernleden.jfif');"></div>
                                        <div class="card__author">
                                            <div class="author">
                                                <div class="author__image">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                                <div class="author__content">
                                                    <p class="author__header">Verantwoordelijken</p>
                                                    <p class="author__subheader">Overzicht verantwoordelijken</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card__body">
                                        <h2 class="card__headline">Verantwoordelijken</h2>
                                        <p class="card__text">Bekijk alle verantwoordelijke van de verschillende verenigingen.</p>
                                    </div>
                                    <div class="card__foot">
                                        <span class="card__link">Ga verder</span>
                                    </div>
                                    <div class="card__border"></div>
                                </a>
                            </div>

                            <div class="col-lg-4 cardpadding">
                                <a href="/admin/verenigingen" class="card">
                                    <div class="card__head">
                                        <div class="card__image" style="background-image: url('assets/adminpanel/verenigigen.jfif');"></div>
                                        <div class="card__author">
                                            <div class="author">
                                                <div class="author__image">
                                                    <i class="fab fa-vuejs"></i>
                                                </div>
                                                <div class="author__content">
                                                    <p class="author__header">Verenigingen</p>
                                                    <p class="author__subheader">Beheer verenigingen</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card__body">
                                        <h2 class="card__headline">Verenigingen</h2>
                                        <p class="card__text">Wijzig verenigingen hun gegevens, maak nieuwe verenigingen aan of verwijder ze, zet verenigingen op actief of non-actief.</p>
                                    </div>
                                    <div class="card__foot">
                                        <span class="card__link">Ga verder</span>
                                    </div>
                                    <div class="card__border"></div>
                                </a>
                            </div>

                            <div class="col-lg-4 cardpadding">
                                <a href="/admin/vrijwilligers" class="card">
                                    <div class="card__head">
                                        <div class="card__image" style="background-image: url('assets/adminpanel/vrijwilliger.jfif');"></div>
                                        <div class="card__author">
                                            <div class="author">
                                                <div class="author__image">
                                                    <i class="fas fa-hands-helping"></i>
                                                </div>
                                                <div class="author__content">
                                                    <p class="author__header">Vrijwilligers</p>
                                                    <p class="author__subheader">Beheer vrijwilligers</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card__body">
                                        <h2 class="card__headline">Vrijwilligers</h2>
                                        <p class="card__text">Wijzig vrijwilligers hun gegevens, maak nieuwe vrijwilligers aan of verwijder ze.</p>
                                    </div>
                                    <div class="card__foot">
                                        <span class="card__link">Ga verder</span>
                                    </div>
                                    <div class="card__border"></div>
                                </a>
                            </div>

                            <div class="col-lg-4 cardpadding">
                                <a href="/admin/tshirt" class="card">
                                    <div class="card__head">
                                        <div class="card__image" style="background-image: url('assets/adminpanel/tshirt.jfif');"></div>
                                        <div class="card__author">
                                            <div class="author">
                                                <div class="author__image">
                                                    <i class="fas fa-tshirt"></i>
                                                </div>
                                                <div class="author__content">
                                                    <p class="author__header">T-shirts</p>
                                                    <p class="author__subheader">Beheer t-shirts</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card__body">
                                        <h2 class="card__headline">T-shirts</h2>
                                        <p class="card__text">Bekijk alle types van t-shirts per vereniging en het aantal per maat.</p></p>
                                    </div>
                                    <div class="card__foot">
                                        <span class="card__link">Ga verder</span>
                                    </div>
                                    <div class="card__border"></div>
                                </a>
                            </div>

                            <div class="col-lg-4 cardpadding">
                                <a href="/admin/Lunchpakket" class="card">
                                    <div class="card__head">
                                        <div class="card__image" style="background-image: url('assets/adminpanel/lunch.jfif');"></div>
                                        <div class="card__author">
                                            <div class="author">
                                                <div class="author__image">
                                                    <i class="fas fa-hamburger"></i>
                                                </div>
                                                <div class="author__content">
                                                    <p class="author__header">Lunchpakketten</p>
                                                    <p class="author__subheader">Beheer lunchpakketten</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card__body">
                                        <h2 class="card__headline">Lunchpakketten</h2>
                                        <p class="card__text">Wijs lunchpakketten toe aan gebruikers van verenigingen.
                                            </p>
                                    </div>
                                    <div class="card__foot">
                                        <span class="card__link">Ga verder</span>
                                    </div>
                                    <div class="card__border"></div>
                                </a>
                            </div>

                            <div class="col-lg-4 cardpadding">
                                <a href="/admin/Tijdsregistratie" class="card">
                                    <div class="card__head">
                                        <div class="card__image" style="background-image: url('assets/adminpanel/time.jfif');"></div>
                                        <div class="card__author">
                                            <div class="author">
                                                <div class="author__image">
                                                    <i class="fas fa-stopwatch"></i>
                                                </div>
                                                <div class="author__content">
                                                    <p class="author__header">Tijdsregistraties</p>
                                                    <p class="author__subheader">Beheer tijdsregistratie</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card__body">
                                        <h2 class="card__headline">Tijdsregistraties</h2>
                                        <p class="card__text">Bekijk tijdsregistraties per vereniging per gebruiker en vul eventuele check in of check uit tijden aan.</p>
                                    </div>
                                    <div class="card__foot">
                                        <span class="card__link">Ga verder</span>
                                    </div>
                                    <div class="card__border"></div>
                                </a>
                            </div>
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


                            <script>
                                const height = elem => {

                                    return elem.getBoundingClientRect().height;

                                };

                                const distance = (elemA, elemB, prop) => {

                                    const sizeA = elemA.getBoundingClientRect()[prop];
                                    const sizeB = elemB.getBoundingClientRect()[prop];

                                    return sizeB - sizeA;

                                };

                                const factor = (elemA, elemB, prop) => {

                                    const sizeA = elemA.getBoundingClientRect()[prop];
                                    const sizeB = elemB.getBoundingClientRect()[prop];

                                    return sizeB / sizeA;

                                };

                                document.querySelectorAll('.card').forEach(elem => {

                                    const head = elem.querySelector('.card__head');
                                    const image = elem.querySelector('.card__image');
                                    const author = elem.querySelector('.card__author');
                                    const body = elem.querySelector('.card__body');
                                    const foot = elem.querySelector('.card__foot');

                                    elem.onmouseenter = () => {

                                        elem.classList.add('hover');

                                        const imageScale = 1 + factor(head, body, 'height');
                                        image.style.transform = `scale(${imageScale})`;

                                        const bodyDistance = height(foot) * -1;
                                        body.style.transform = `translateY(${bodyDistance}px)`;

                                        const authorDistance = distance(head, author, 'height');
                                        author.style.transform = `translateY(${authorDistance}px)`;

                                    };

                                    elem.onmouseleave = () => {

                                        elem.classList.remove('hover');

                                        image.style.transform = `none`;
                                        body.style.transform = `none`;
                                        author.style.transform = `none`;

                                    };

                                });
                            </script>
@endsection



