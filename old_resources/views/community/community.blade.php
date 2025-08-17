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
    <div class="container-fluid px-3 px-lg-5 m-0 bg-gray">
        <div class="container mx-auto row px-0">
            <div class="col-24 col-lg-6 px-2 mt-3 h-100 d-flex flex-column">
                    @includeIf('community.components.about-us')
                    @includeIf('community.components.relatedCommunities')
                    @includeIf('community.components.relatedTour')
            </div>
            <div class="col-24 col-lg-18 px-2 mt-3 h-100 d-flex flex-column">
                @includeIf('community.components.community-header')
                @includeIf('community.components.new_post')
                <div class="w-100 mb-5">
                    @forelse($community->communityUserPosts()->get() as $post)
                        @includeIf('community.components.posts')
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
