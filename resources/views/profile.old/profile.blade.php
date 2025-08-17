@extends('layout.layout-react-public')

@section("title", "Profile")

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
    @includeIf("profile.components.navbar")
    <!-- <div class="container mx-auto flex gap-5">
        <div class="basis-4/6 ">
            @includeIf('profile.components.user-info-sidebar')
            @includeIf("profile.components.badge")
            @includeIf("profile.components.certificate")
            @includeIf("profile.components.post")
        </div>
        <div class="basis-2/6 ">
            @includeIf("profile.components.skills")
            @includeIf("profile.components.joint-trips")
        </div>
    </div> -->
    <div id="profile-pro" user="{{$user}}" followers="{{$user->followers()->count()}}" following="{{$user->following()->count()}}"></div>
@endsection

{{--@section('content')--}}
{{--    <div class="container-fluid m-0 p-0 bg-light-gray">--}}
{{--        <div class="container mx-auto">--}}
{{--            <div class="row gy-4 justify-content-center px-0 pt-4">--}}
{{--                <div class="col-23 col-lg-6">--}}
{{--                    @includeIf('profile.components.user-info-sidebar')--}}
{{--                </div>--}}
{{--                <div class="col-23 col-lg-18 ps-0 ps-lg-3 pe-0 mb-5">--}}
{{--                    @includeIf('profile.components.header')--}}
{{--                    <div class="row gy-4 px-0 mt-3">--}}
{{--                        <div class="col-24 col-lg-16">--}}
{{--                            @includeIf('profile.components.posts')--}}
{{--                        </div>--}}
{{--                        <div class="col-24 col-lg-8">--}}
{{--                            @includeIf('profile.components.groups')--}}
{{--                            @includeIf('profile.components.communities')--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
