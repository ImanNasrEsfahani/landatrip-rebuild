@extends('layout.layout')

@section("title", "Language Courses")

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
    Language Courses
@endsection
