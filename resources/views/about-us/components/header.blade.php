<div class="container-fluid position-relative py-5 overflow-hidden min-vh-100 min-vh-md-50 min-vh-lg-50 d-flex flex-column justify-content-center">
    <picture>
        <source media="(min-width: 1200px)" src="{{ Storage::url("/website/about-us/header-large.webp") }}" >
        <source media="(min-width: 576px)" src="{{ Storage::url("/website/about-us/header-medium.webp") }}" >
        <source src="{{ Storage::url("/website/about-us/header-mobile.webp") }}">
        <img class="position-absolute top-0 start-0 h-100 w-100 h-lg-auto z-index-n-100 lazyload" src="{{ Storage::url("/website/about-us/header.png") }}"  alt="Landa-Trip-About-Us-Image">
    </picture>
    <div class="container text-center">
        <h1 class="text-white fw-bolder h2 mb-4">{{ __('pages/about-us.About us') }}</h1>
        <h5 class="text-white fs-4 fw-light mt-4 mx-auto lh-md w-100 w-md-75 w-lg-50 lh-base">{{ __('pages/about-us.Sub Title') }}</h5>
    </div>
</div>
