@extends('layout.layout-react-public')

@section("title", "Home Page")

@section("keywords")
    @switch(app()->getLocale())
        @case("fr")
            <meta name="keywords" content="french">
            @break
        @case("fa")
            <meta name="keywords" content="فارسی">
            @break
        @default
            <meta name="keywords"
                content="educational trip, field trip, study trip, educated travel, educational travel, student travel programs, educational tours, learning vacations, educational journey, experiential trip, travel courses, practical courses, training courses, education in travel, education in form of travel, traveling courses, school trip, peer group activities, learning adventure seekers, Amazing trips, science travel grants, business trip, business travel, traveling workshop, workshop traveling, business trip plan, certificate courses in travel, travel with expert, travel courses with a certificate, get the certificate on trip, Traveling Workshops Program, smart trip, Experimental Travel, learning in nature, scientific tours, learning without limitation, learning without borders, scientific learning trip, business communicational trip, graduated learning trip, degree in trip, student trips, Educational School Trips, Easy School Trip Planning, Peer Group Visits">
    @endswitch
@endsection
@section('content')
    @includeIf('home-page.components.hero')
    @includeIf('home-page.components.values')
    @includeIf('home-page.components.choises')
    @includeIf('home-page.components.progress')
    @includeIf('home-page.components.deals')
    @includeIf('home-page.components.comments')
    @includeIf('home-page.components.magazine')
    @includeIf('home-page.components.partnership')
@endsection

{{--@section('content')--}}{{--    <script src="https://cdn.jsdelivr.net/npm/lazysizes@5.3.2/lazysizes.min.js" defer></script>--}}{{--    @includeIf('home-page.components.header')--}}{{--    @includeIf('home-page.components.our-services')--}}{{--    @includeIf('home-page.components.who-are-you')--}}{{--    @includeIf('home-page.components.featured-courses')--}}{{--    @includeIf('home-page.components.skills')--}}{{--    @includeIf('home-page.components.last-minute-deal')--}}{{--    @includeIf('home-page.components.user-feedback')--}}{{--    @includeIf('home-page.components.why-choose-us')--}}{{--    @includeIf('home-page.components.testimonial')--}}{{--@endsection--}}
