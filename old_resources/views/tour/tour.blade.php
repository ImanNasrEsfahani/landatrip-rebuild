@extends('layout.layout-react-public')

@section("title", "Travel Course Page")

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
    @includeIf('tour.components.header')
    <div class="container mx-auto flex flex-col-reverse lg:flex-row gap-20 md:gap-40 mt-20">
        <div class="basis-full lg:basis-5/6">
            @includeIf('tour.components.tour-overview')
            @includeIf('tour.components.highlights')
            <div class="flex flex-col md:flex-row gap-5 w-full mt-32" id="include-exclude">
                <div class="basis-full lg:basis-1/2 pl-0">
                    @includeIf("tour.components.includes")
                </div>
                <div class="basis-full lg:basis-1/2">
                    @includeIf("tour.components.excludes")
                </div>
            </div>
            <div class="overflow-hidden my-4">
                @includeIf("tour.components.gallery")
                @includeIf("tour.components.certificates")
                @includeIf("tour.components.maps")
            </div>
            @includeIf("tour.components.new-date")
            @includeIf('tour.components.itinerary-detail')
            @includeIf("tour.components.terms-and-condition")
            @includeIf("tour.components.comments")
            @includeIf("tour.components.comments-form")
            @includeIf("tour.components.login-popup")
        </div>
        <div class="basis-full lg:basis-1/6 relative ">
            <div class="sticky top-5 pb-3">
                @includeIf("tour.components.navbar")
            </div>
        </div>
    </div>
    <script>
        function loginHandler(event) {
            event.preventDefault();
            login_popup.showModal();
        }
    </script>
@endsection
