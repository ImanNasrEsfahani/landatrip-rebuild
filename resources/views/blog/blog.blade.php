@extends('layout.layout')

@section("title", "Community Page")

@section("description"){{ $article->description }}@endsection

@section("keywords")
    @switch(app()->getLocale())
        @case("fr")
            <meta name="keywords" content="{{ $article->keywords }}">
            @break
        @case("fa")
            <meta name="keywords" content="{{ $article->keywords }}">
            @break
        @default
            <meta name="keywords" content="{{ $article->keywords }}">
    @endswitch
@endsection

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/lazysizes@5.3.2/lazysizes.min.js" defer></script>
    @includeIf('blog.components.blog_body')
@stop
