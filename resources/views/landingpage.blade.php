@extends('layouts.templatesnoshade')
@section('title', 'Tijdsregistratiesysteem')
@section('css_after')

            <style>
                body, html {
                    background-image:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("assets/images/hero.jfif") ;
                    background-repeat: no-repeat;
                    background-attachment: fixed;
                    background-size: cover;
                    background-position: center;
                    background-color: #443339 ;
                    isolation: isolate;
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
                    min-height: 70vh;
                }
                .hidden{
                    display: none;
                }

                .btn-gladiolen{
                    background: #0C225D;
                    color: white;
                }
                .btn-gladiolen:hover{
                    background: #5DB4FF;
                    color: white;
                }


            </style>
        @endsection

        @section('main')

            <header>

                <div class="hero-text hidden">
                    <h1>Tijdsregistratiesysteem</h1>
                    <h1>Keizer Karel Olen</h1>
                    @guest
                        <p>Meld je hier aan om gebruik te maken van het Tijdsregistratiesysteem van VZW Keizer Karel Olen</p>
                        <br><br>
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="/login"><button  type="button" class="btn btn-gladiolen btn-lg">Inloggen</button></a>
                            </div>
                            <div class="col-lg-6">
                                <a href="/aanvraagverantwoordelijke"><button  href="/aanvraagverantwoordelijke" type="button" class="btn btn-gladiolen btn-lg">Vereniging aanvragen</button></a>
                            </div>
                        </div>
                    @endguest
                    @if(auth()->user()->rollId==1)


                                @endif
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
