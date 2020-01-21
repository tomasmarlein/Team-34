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

    <header>

        <div class="hero-text hidden">
            <h1>Tijdsregistratiesysteem</h1>
            <h1>Keizer Karel Olen</h1>
            @guest
                <p>Meld je hier aan om gebruik te maken van het Tijdsregistratiesysteem tijdens evenementen van VZW Keizer Karel Olen</p>
                <a href="/login"><button  type="button" class="btn btn-warning btn-lg">Inloggen</button></a>
                <a href="/aanvraag"><button  href="/aanvraag" type="button" class="btn btn-warning btn-lg">Samenwerking</button></a>
            @endguest
            {{--            @if(auth()->user()->admin)

                        knoppen voor admins
                        @endif--}}
        </div>
    </header>
@endsection
@section('script_after')
    <script>
        $(document).ready(function () {
            $('div.hidden').fadeIn(2000).removeClass('hidden');
        });
    </script>
@endsection
