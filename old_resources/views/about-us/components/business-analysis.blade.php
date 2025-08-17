<div class="container mx-auto pt-14">
    <div class="row gy-4">
        <div class="col-24 col-lg-12 align-self-center">
            <div class="position-relative">
                <i class="position-absolute top-n-40 start-0 fa-sharp fa-solid fa-circle fa-4x text-orange opacity-50 z-index-n-100"></i>
                <h3 class="h2 text-green fw-semibold pb-3">{{ __('pages/about-us.Business Analysis') }}</h3>
            </div>
            <p class="fs-4 fs-bold text-justify">{{ __('pages/about-us.Business Analysis sub') }}</p>
        </div>
        <div class="col-24 col-lg-12 text-center text-lg-end">
            <picture>
                <source src="{{ Storage::url("/website/about-us/business-analysis.webp") }}">
                <img class="w-100 h-auto w-xl-auto h-xl-100 rounded-5 lazyload" src="{{ Storage::url("/website/about-us/business-analysis.png") }}"  alt="Landa-Trip-Business-Analysis-Image">
            </picture>
        </div>
    </div>
</div>
