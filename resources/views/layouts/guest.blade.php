<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="author" content="PFJ 2022">
        <meta name="description" content="{{ config('app.description', 'Para la Fortaleza de la Juventud' ) }}">
        <meta property="og:image" content="{{ config('app.url', 'http://localhost/').'/img/logo_pfj2022.jpg' }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('img/logo_pfj2022.jpg') }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PFJ') }}</title>
        <link rel="shortcut icon" href="{{ config('app.url', 'https://www.pfjperu.com') }}/favicons/favicon.ico">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <!-- Styles -->
        <link rel="stylesheet" href="{{ config('app.url', 'https://www.pfjperu.com').'/css/app.css' }}">

        <!-- Scripts -->
        <script src="{{ config('app.url', 'https://www.pfjperu.com').'/js/app.js' }}" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
