<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.css') }}" type="text/css"></link>
        <link rel="stylesheet" href="{{ asset('assets/frontend/style.css') }}" type="text/css"></link>
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/dark.css') }}" type="text/css"></link>
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/font-icons.css') }}" type="text/css"></link>
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/animate.css') }}" type="text/css"></link>
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/magnific-popup.css') }}" type="text/css"></link>
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/custom.css') }}" type="text/css"></link>

        <link rel="stylesheet" href="{{ mix('css/app.css') }}" type="text/css"></link>
        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="stretched">
        @inertia
        <!-- JavaScripts
        ============================================= -->
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('js/functions.js') }}"></script>
    </body>
</html>
