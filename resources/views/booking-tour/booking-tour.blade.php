@extends('layout.layout-material-public')

@section("title", "Booking Tour")

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
    <div id="booking-tour" tour_slug="{{ $tour->slug }}" group_slug="{{ $group->slug }}"></div>
@endsection
