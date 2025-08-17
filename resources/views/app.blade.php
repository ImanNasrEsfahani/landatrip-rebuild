<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
{{--        <link href="{{ asset('scss.scss') }}" rel="stylesheet">--}}
        <title>Laravel</title>
        @inertiaHead
    </head>
    <body>
    @includeIf('navbar.navbar')
    @inertia
    @viteReactRefresh
    @vite(['resources/scss.scss', 'resources/js/app.jsx'])

    @includeIf('footer.footer')
    </body>
</html>
