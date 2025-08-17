





<div
    class="position-relative container mx-auto py-4 text-center rounded-4 min-vh-90 min-vh-lg-60 min-vh-xl-50 min-vh-xxl-40 d-flex flex-column justify-content-center tour-bg-header">
    {{--    <h1 class="text-white fw-bolder fs-7 w-100 w-lg-75 mx-auto text-shadow z-index-100">{{ $tour->title }}</h1>--}}
    {{--    <p class="text-white lh-base fw-normal fs-4 w-100 w-lg-75 mx-auto text-shadow z-index-100">{{ $tour->short_summary }}</p>--}}
    {{--    @if(auth()->check())--}}
    {{--        @if(auth()->id() === $user->id)--}}

    {{--        @endif--}}
    {{--    @endif--}}

    <div
        class="d-flex flex-row justify-content-between align-items-center w-100 blur-stripe position-absolute bottom-0 start-0 rounded-bottom py-2 min-vh-5">
        <div class="row w-100 m-0 p-0">
            <span class="col-24 col-md-16 text-center text-md-start">
                @if(auth()->check())
                    @if(auth()->id() !== $user->id)
                        <div class="react-follow-button" user-slug="{{ $user->slug }}" followed="{{ auth()->user()->following()->where('followed_id', $user->id)->first() ? "true" : "false" }}"></div>
                    @else
                        <div>
                <a href="#"
                   class="btn blur-stripe text-white bg-orange px-4 py-1 mx-3 rounded-pill px-4 py-1">{{ __('pages/profile.Edit Cover Photo') }}</a>
            </div>
                    @endif
                @else
                    <a class="btn btn-orange text-white align-self-center rounded-pill ms-2"
                       href="{{ route('login') }}">Login</a>
                @endif
        </span>
        </div>
    </div>
</div>

<style>
    .tour-bg-header {
        @if( $user->headerImage)
                background-image: url("{{ asset("/users/header/" . $user->headerImage->url ) }}");
        @else
             background-image: url("{{ asset("/users/header/default.png") }}");
        @endif
            background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }

    .blur-stripe {
        background: rgba(255, 255, 255, 0.28);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(8.7px);
        -webkit-backdrop-filter: blur(8.7px);
        border: 1px solid rgba(255, 255, 255, 0.37);
    }
</style>
