<div class="d-block"><h4 class="h6 d-inline-block text-black">{{ __('pages/profile.Company') }}</h4> <p class="d-inline-block fs-2 text-dark-gray mb-2">{{ $user->userCompanies->last()?->company_name }}</p></div>
<div class="d-block"><h4 class="h6 d-inline-block text-black">{{ __('pages/profile.Education Level') }}</h4> <p class="d-inline-block fs-2 text-dark-gray mb-2">{{ __('pages/profile.Master') }}</p></div>
<div class="d-block"><h4 class="h6 d-inline-block text-black">{{ __('pages/profile.Experience Level') }}</h4> <p class="d-inline-block fs-2 text-dark-gray mb-2">{{ __('pages/profile.medior') }}</p></div>
<div class="d-flex flex-row justify-content-around w-100 mt-3 mb-4">
    @if(!empty(trim($user->twitter)))
        <a class="text-decoration-none" href="{{ $user->twitter }}"><i class="fa-brands fa-twitter text-orange border-bottom border-end border-1 border-light-gray p-2 rounded-3 align-self-center shadow-sm"></i></a>
    @endIf
    @if(!empty(trim($user->instagram)))
        <a class="text-decoration-none" href="{{ $user->instagram }}"><i class="fa-brands fa-instagram text-orange border-bottom border-end border-1 border-light-gray p-2 rounded-3 align-self-center shadow-sm"></i></a>
    @endIf
    @if(!empty(trim($user->facebook)))
        <a class="text-decoration-none" href="{{ $user->facebook }}"><i class="fa-brands fa-facebook-f text-orange border-bottom border-end border-1 border-light-gray p-2 rounded-3 align-self-center shadow-sm"></i></a>
    @endIf
    @if(!empty(trim($user->linkedin)))
        <a class="text-decoration-none" href="{{ $user->linkedin }}"><i class="fa-brands fa-linkedin-in text-orange border-bottom border-end border-1 border-light-gray p-2 rounded-3 align-self-center shadow-sm"></i></a>
    @endIf
        <div>
            <img class="text-orange" src="{{ asset('/users/location.svg') }}"/>
            <p class="ms-2 d-inline-block fs-2 text-dark-gray">{{ $user->location }}</p>
        </div>
        <div>
            <img class="text-orange" src="{{ asset('/users/sex.svg') }}"/>
            <p class="ms-2 d-inline-block fs-2 text-dark-gray">{{ $user->sex->description  }}</p>
        </div>
</div>

<div class="d-block w-100">
    <h6 class="text-black">{{ __('pages/profile.About Me') }}</h6>
    <p class="text-dark mb-0">{{ $user->about_me }}</p>
    <a class="text-orange fs-1 text-decoration-none" href="#">{{ __('pages/profile.Read More') }} ></a>
</div>
