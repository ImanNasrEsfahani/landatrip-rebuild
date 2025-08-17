{{--<div id="certificates" class="my-12">--}}
{{--    <h3 class="text-center lg:text-left text-4xl mt-5 mt-lg-0 text-black fw-bold mb-6">Certificate</h3>--}}
{{--    <div class="flex flex-row">--}}
{{--        @forelse($tour->certificate()->get() as $item)--}}
{{--                <div class="card w-1/2 lg:w-1/4 border-0 shadow mr-4">--}}
{{--                    <div class="pswp-gallery pswp-gallery--single-column" id="my-gallery">--}}
{{--                        <a class="relative" href="{{ Storage::url("/courses/certificate/think-strategically-and-make-your-ideas-a-reality-certificate-01.png") }}"--}}
{{--                           data-pswp-width="{{ getimagesize(Storage::url("/courses/certificate/think-strategically-and-make-your-ideas-a-reality-certificate-01.png"))[0] }}"--}}
{{--                           data-pswp-height="{{ getimagesize(Storage::url("/courses/certificate/think-strategically-and-make-your-ideas-a-reality-certificate-01.png"))[1] }}"--}}
{{--                           data-cropped="true"--}}
{{--                           target="_blank">--}}
{{--                            <img class="w-full" src="{{ Storage::url("/courses/certificate/think-strategically-and-make-your-ideas-a-reality-certificate-01.png") }}" alt="" />--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="card-body text-center">--}}
{{--                        <h5 class="card-text fw-bold">{{ $item->title }}</h5>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--        @empty--}}
{{--            <h1>Empty</h1>--}}
{{--        @endforelse--}}
{{--    </div>--}}
{{--</div>--}}

{{--<section class="splide gallery-splide mt-10" aria-label="Splide Basic HTML Example">--}}
{{--    <div class="splide__track">--}}
{{--        <ul class="splide__list">--}}
{{--            @forelse($tour->gallery()->get() as $galleryObj)--}}
{{--                <li class="splide__slide text-primary">--}}
{{--                    <img class="w-full" src="{{ Storage::url("/courses/certificate/think-strategically-and-make-your-ideas-a-reality-certificate-01.png") }}" alt="" />--}}
{{--                </li>--}}
{{--            @empty--}}
{{--            @endforelse--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--</section>--}}




<div class="mt-32" id="certificate">
    <h4 class="mb-10 text-center lg:text-left text-black text-4xl font-bold">{{ __('pages/tour-lang.Certificates') }}</h4>
    <section class="splide certificate-splide" aria-label="Splide Basic HTML Example">
        <div class="splide__track">
            <ul class="splide__list">
{{--                @forelse($tour->certificate()->get() as $item)--}}
                <li class="splide__slide">
                        <img class=" w-full rounded-xl" src="{{ Storage::url("/website/tours/certificate.png") }}"
                             alt="certificate"/>
{{--                    <h5 class="card-text fw-bold">{{ $item->title }}</h5>--}}
                    <h5 class="card-text fw-bold text-center my-1">certificate</h5>
                </li>
{{--                @empty--}}
{{--                @endforelse--}}
            </ul>
        </div>
    </section>
</div>
