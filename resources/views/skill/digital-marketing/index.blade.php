@extends('layout.layout')

@section("title", "Digital Marketing")

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
    @includeIf('skill.digital-marketing.components.header')
    <div class="container-fluid p-0 m-0 position-relative">
        <div class="position-absolute top-n-15 bg-green min-vh-25 min-vw-100 z-index-n-200"></div>
        <div class="container-fluid bg-green px-0 mx-0 pt-2">
            @includeIf('skill.digital-marketing.components.features')
        </div>
    </div>

    @includeIf('skill.digital-marketing.components.fit-character-for-digital-marketing')
@endsection
