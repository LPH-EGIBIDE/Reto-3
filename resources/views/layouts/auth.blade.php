<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Inicio de sesion - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<body id="app-layout" >

<div id="page-wrapper">
    <div class="container" id="main">
        <div>
            @yield('content')
        </div>
    </div>
</div>
<style>
    .link{
        color: #1a459a;
        cursor: pointer;
    }

    .link:hover{
        color: black;
    }
</style>
</body>
</html>
