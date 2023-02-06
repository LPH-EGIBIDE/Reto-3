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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.2.3/flatly/bootstrap.min.css" integrity="sha512-q+Sm01IL0q3keoeZkh7cHh6CcUGU0LVwFIf9Il4utcw0oC2MH9mpATEyvuh6dbzDiV8Pw4CXlsT7O1zXFc0LwQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
