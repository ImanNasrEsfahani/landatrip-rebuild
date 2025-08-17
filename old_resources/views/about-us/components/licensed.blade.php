<div class="container mx-auto pt-14">
    <div class="row">
        <div class="col-24 col-md-12 col-lg-8 align-self-center">
            <h4 class="h2 text-green fw-semibold pb-3 text-green">{{ __('pages/about-us.Licensed') }}</h4>
            <p class="fs-4 fs-bold text-justify">{{ __('pages/about-us.Licensed sub') }}</p>
        </div>
        <div class="col-24 col-md-12 col-lg-16 d-flex flex-row justify-content-end text-center">
            <div class="pswp-gallery pswp-gallery--single-column" id="my-gallery">
                <a class="position-relative" href="{{ Storage::url("/website/about-us/certificate-of-authorization-from-landa.webp") }}"
                   data-pswp-width="{{ getimagesize(Storage::url("/website/about-us/certificate-of-authorization-from-landa.webp"))[0] }}"
                   data-pswp-height="{{ getimagesize(Storage::url("/website/about-us/certificate-of-authorization-from-landa.webp"))[1] }}"
                   data-cropped="true"
                   target="_blank">
                    <img src="{{ Storage::url("/website/about-us/certificate-of-authorization-from-landa-thumbnail.webp") }}" alt="" />
                </a>
                <a class="position-relative" href="{{ Storage::url("/website/about-us/certificate-of-partnership-from-forough-co.webp") }}"
                   data-pswp-width="{{ getimagesize(Storage::url("/website/about-us/certificate-of-partnership-from-forough-co.webp"))[0] }}"
                   data-pswp-height="{{ getimagesize(Storage::url("/website/about-us/certificate-of-partnership-from-forough-co.webp"))[1] }}"
                   data-cropped="true"
                   target="_blank">
                    <img src="{{ Storage::url("/website/about-us/certificate-of-partnership-from-forough-co-thumbnail.webp") }}" alt="" />
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .license-bg-image-01 {
        background-image: url("{{ asset('/website/about-us/license-bg-image-01.webp') }}");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }
</style>
