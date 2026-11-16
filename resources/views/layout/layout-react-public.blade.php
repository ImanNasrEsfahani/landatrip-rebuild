<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if($current_locale == "fa") dir="rtl"
    @else dir="ltr" @endif>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - Landa Trip</title>
    <meta name="description"
        content="@yield('description', "Landa Trip is an intelligent educational travel marketplace that is screening, verifying, and connecting students, employees, and interested skill workers to educational institutions around the world in a competitive and safe environment to participate in group educational travel.")"/>
    <meta name="robots" content="index, follow">
    <meta name="author" content="Iman Nasr Esfahani"/>
    <meta http-equiv="Content-Type" content="text/html; charset = UTF-8"/>
    <meta name="revised" content="{{ \Carbon\Carbon::yesterday()->format("Y-m-d") }}"/>
    @yield('keywords')

    <link rel="apple-touch-icon" sizes="57x57" href="{{ Storage::url('/fav/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ Storage::url('/fav/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ Storage::url('/fav/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ Storage::url('/fav/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ Storage::url('/fav/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ Storage::url('/fav/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ Storage::url('/fav/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ Storage::url('/fav/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ Storage::url('/fav/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ Storage::url('/fav/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ Storage::url('/fav/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ Storage::url('/fav/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ Storage::url('/fav/favicon-16x16.png')}}">
    <link rel="manifest" href="{{ Storage::url('/fav/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ Storage::url('/fav/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        div#body {
            opacity: 0;
            animation: fadeOutAnimation ease-out 2s;
            animation-iteration-count: 1;
            animation-fill-mode: forwards;
        }

        @keyframes fadeOutAnimation {
            0% {
                opacity: 0;
            }
            80% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
<noscript>Please Turn on your Javascript in your browser!</noscript>
@include('loading.loading')

<div id="body" style="opacity: 0" class="bg-white">
    @include('navbar.navbar')
    @yield("content")
    @include('footer.footer')
</div>

@viteReactRefresh
@vite(['resources/scss/public.scss', 'resources/js/react-public.js'])



<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-5E72BJXMZV"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'G-5E72BJXMZV');
</script>

</body>
</html>
