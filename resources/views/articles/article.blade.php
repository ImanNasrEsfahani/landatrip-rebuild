@extends('layout.layout')

@section("title", "Community Page")

@section("keywords")
    @switch(app()->getLocale())
        @case("fr")
            <meta name="keywords" content="french">
            @break
        @case("fa")
            <meta name="keywords" content="فارسی">
            @break
        @default
            <meta name="keywords" content="English">
    @endswitch
@endsection

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/lazysizes@5.3.2/lazysizes.min.js" defer></script>
    @includeIf('articles.components.header')
    @includeIf('articles.components.our-services')
    @includeIf('articles.components.last_articles')
    @includeIf('articles.components.popular-articles')
{{--    @includeIf('articles.components.top-creator')--}}
@stop
