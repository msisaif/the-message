<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="Content-Type" content="text/html: charset=utf-8" />

        <title inertia>{{ config('app.name', 'The Message') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased overflow-y-scroll bg-brand-light">
        @inertia
    </body>
</html>
