<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('css_after')
    <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}">
    <title>@yield('title', 'Tijdsregistratiesysteem')</title>
</head>
<body>
{{--  Navigation  --}}
@include('shared.navigation')
{{--  Navigation  --}}
<main class="container mt-3" id="content">
        @yield('main', 'Pagina onder constructie...')
</main>
{{--  Footer  --}}
@include('shared.footer')
{{--  Footer  --}}
<script src="{{ mix('js/app.js') }}"></script>
@yield('script_after')
@if(env('APP_DEBUG'))
    <script>
        $('form').attr('novalidate', 'true');  //verwijderen voor prod --> client side validation
    </script>
@endif
</body>
</html>


