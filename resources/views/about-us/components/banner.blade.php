<div class="d-flex flex-column justify-content-center container-fluid mx-auto px-0 pt-14 min-vh-100 min-vh-md-75 min-vh-xl-50 about-us-bg-image">
{{--    <img class="position-absolute z-index-n-200 h-100 w-auto h-lg-auto w-lg-100" src="{{ asset("/storage/website/about-us/banner-background.png") }}" alt="">--}}
    <div class="container mx-auto">
        <h2 class="h1 text-white text-center text-uppercase fw-bolder pt-6 pb-0">{{ __('pages/about-us.go travel and learning') }}</h2>
        <h2 class="h1 text-white text-center text-uppercase fw-bolder pt-1 pb-4">{{ __('pages/about-us.Remember us') }}</h2>
        <p class="text-white text-center lh-lg fs-5 pb-3">{{ __('pages/about-us.We are your technical advisor') }} </p>
        <div class="row gy-4 mx-auto pb-7">
            <div class="col-24 col-md-12 col-xl-6 text-white">
                <div class="d-flex justify-content-between bg-orange rounded-4 bg-opacity-50 py-2 px-3">
                    <span class="col-11 justify-content-center text-center align-self-center">
                        <img class="h-auto lazyload" src="{{ Storage::url("/website/about-us/courses-icon.webp") }}"  alt="">
                    </span>
                    <span class="col-1 vl"></span>
                    <span class="col-10 d-flex flex-column justify-content-center text-center">
                        <p class="fw-bold h4 mb-1">131+</p>
                        <p class="fs-2 mb-0">{{ __('pages/about-us.Courses') }}</p>
                    </span>
                </div>
            </div>
            <div class="col-24 col-md-12 col-xl-6 text-white">
                <div class="d-flex justify-content-between bg-orange rounded-4 bg-opacity-50 py-2 px-3">
                    <span class="col-11 justify-content-center text-center align-self-center">
                        <img class="h-auto lazyload" src="{{ Storage::url("/website/about-us/skills-icon.webp") }}"  alt="">
                    </span>
                    <span class="col-1 vl"></span>
                    <span class="col-10 d-flex flex-column justify-content-center text-center">
                        <p class="fw-bold h4 mb-1">5</p>
                        <p class="fs-2 mb-0">{{ __('pages/about-us.Skills') }}</p>
                    </span>
                </div>
            </div>
            <div class="col-24 col-md-12 col-xl-6 text-white">
                <div class="d-flex justify-content-between bg-orange rounded-4 bg-opacity-50 py-2 px-3">
                    <span class="col-11 justify-content-center text-center align-self-center">
                        <img class="h-auto lazyload" src="{{ Storage::url("/website/about-us/student-icon.png") }}"  alt="">
                    </span>
                    <span class="col-1 vl"></span>
                    <span class="col-10 d-flex flex-column justify-content-center text-center">
                        <p class="fw-bold h4 mb-1">2000+</p>
                        <p class="fs-2 mb-0">{{ __('pages/about-us.Student') }}</p>
                    </span>
                </div>
            </div>
            <div class="col-24 col-md-12 col-xl-6 text-white">
                <div class="d-flex justify-content-between bg-orange rounded-4 bg-opacity-50 py-2 px-3">
                    <span class="col-11 justify-content-center text-center align-self-center">
                        <img class="h-auto lazyload" src="{{ Storage::url("/website/about-us/location-icon.png") }}"  alt="">
                    </span>
                    <span class="col-1 vl"></span>
                    <span class="col-10 d-flex flex-column justify-content-center text-center">
                        <p class="fw-bold h4 mb-1">100+</p>
                        <p class="fs-2 mb-0">{{ __('pages/about-us.Tour Operated') }}</p>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .about-us-bg-image {
        background-image:{{ Storage::url("/website/about-us/heart-and-hand.svg") }};
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>
