<div class="container mx-auto pt-14">
    <div class="row gy-4">
        <div class="col-24 col-lg-12 text-center text-lg-start order-last order-lg-first">
            <picture>
                <source data-srcset="{{ asset("/website/about-us/leadership.webp") }}">
                <img class="w-100 h-auto w-xl-auto h-xl-100 rounded-5 lazyload" src="{{ Storage::url("/website/about-us/leadership.png") }}"  alt="Landa-Trip-Leadership-Image">
            </picture>
        </div>
        <div class="col-24 col-lg-12 align-self-center">
            <div class="position-relative">
                <i class="position-absolute top-n-40 start-0 fa-sharp fa-solid fa-circle fa-4x text-light-blue opacity-50 z-index-n-100"></i>
                <h3 class="h2 text-green fw-semibold pb-3">{{ __('pages/about-us.Leadership') }}</h3>
            </div>
            <p class="fs-4 fs-bold text-justify">{{ __('pages/about-us.Leadership sub') }}</p>
        </div>
    </div>
</div>
