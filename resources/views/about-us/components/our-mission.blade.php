<div class="container mx-auto pt-14">
    <div class="row">
        <div class="col-24 col-lg-12 align-self-center pe-10">
            <h2 class="h2 text-green fw-semibold pb-3 text-green">{{ __('pages/about-us.Our Mission') }}</h2>
            <p class="fs-4 fs-bold text-justify ps-4">{{ __('pages/about-us.Our Mission sub') }}</p>
        </div>
        <div class="col-24 col-lg-12">
        <picture>
            <source data-srcset="{{ Storage::url("/website/about-us/our-mission.webp") }}">
            <img class="w-100 rounded-5 lazyload" data-src="{{ Storage::url("/website/about-us/our-mission.png") }}" alt="Landa-Trip-Our-Mission-Image">
        </picture>
        </div>
    </div>
</div>
