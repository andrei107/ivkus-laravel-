<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gusto</title>
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="/css/main.css">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
        @include('layouts.header')
        @yield('content')
        @include('layouts.footer')
        <script src="/js/app.js"></script>
        <script src="/js/bootstrap.js"></script>
        <script src="/js/main.js"></script>
    </body>
</html>
