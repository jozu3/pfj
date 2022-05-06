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

        <title>PFJ</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ config('app.url', 'https://www.pfjperu.com').'/css/app.css' }}">
        <link rel="stylesheet" href="{{ config('app.url', 'https://www.pfjperu.com').'/vendor/fontawesome-free/css/all.min.css' }}">


        @livewireStyles

        <!-- Scripts -->
        <script src="{{ config('app.url', 'https://www.pfjperu.com').'/js/app.js' }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
