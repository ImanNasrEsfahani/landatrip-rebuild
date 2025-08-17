<div class="container mx-auto pt-14">
    <div class="row gy-4">
        <div class="col-24 col-lg-12 align-self-center">
            <div class="position-relative">
                <i class="position-absolute top-n-40 start-0 fa-sharp fa-solid fa-circle fa-4x text-light-purpol opacity-50 z-index-n-100"></i>
                <h3 class="h2 text-green fw-semibold pb-3">{{ __('pages/about-us.Language Courses') }}</h3>
            </div>
            <p class="fs-4 fs-bold text-justify">{{ __('pages/about-us.Language Courses sub') }}</p>
        </div>
        <div class="col-24 col-lg-12 text-center text-lg-end">
            <picture>
                <source data-srcset="{{ asset("/website/about-us/language-course.webp") }}">
                <img class="w-100 h-auto w-xl-auto h-xl-100 rounded-5 lazyload" src="{{ Storage::url("/website/about-us/language-course.png") }}" alt="Landa-Trip-Language-Course-Image">
            </picture>
        </div>
    </div>
</div>
