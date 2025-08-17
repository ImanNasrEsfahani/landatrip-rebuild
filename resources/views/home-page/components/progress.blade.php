<div class="my-20 container mx-auto text-black">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 ">
        <picture class="hidden lg:block self-center h-full">
            <source class="h-full" media="(min-width: )"
                src="{{ Storage::url('/website/homepage/how-it-works.webp') }}" alt="how-it-works">
            <img class="h-full" src="{{ Storage::url('/website/homepage/how-it-works.png') }}"
                alt="how-it-works">
        </picture>
        <div class="flex flex-col gap-y-5 justify-between">
            <div>
                <p class="text-xl text-[#4F4F4F] text-center lg:text-left"> How it works </p>
            </div>
            <div>
                <p class="text-4xl text-center lg:text-left font-semibold">Start Your Adventure With Just One Click</p>
            </div>
            <div class="card w-full flex-col lg:flex-row shadow-xl ">
                <img class="px-8 hidden lg:block self-center h-[40%]" src="{{ Storage::url('/website/homepage/icon-destination.svg') }}"
                    alt="icon-destination">
                <div class="card-body lg:pl-0">
                    <h2 class="card-title"> <img class="lg:hidden" src="{{ Storage::url('/website/homepage/icon-destination.svg') }}"
                        alt="icon-destination"> Find your destination</h2>
                    <p>Explore unknown destinations and learn new skills from top educators.</p>
                </div>
            </div>
            <div class="card w-full flex-col lg:flex-row shadow-xl">
                <img class="px-8 hidden lg:block self-center h-[40%]" src="{{ Storage::url('/website/homepage/icon-book.svg') }}" alt="icon-book">
                <div class="card-body lg:pl-0">
                    <h2 class="card-title"><img class="lg:hidden" src="{{ Storage::url('/website/homepage/icon-book.svg') }}" alt="icon-book"> Book a group</h2>
                    <p>Ensure a smooth travel experience by booking tickets to your preferred destination via our
                        booking platform.</p>
                </div>
            </div>
            <div class="card w-full flex-col lg:flex-row shadow-xl ">
                <img class="px-8 hidden lg:block self-center h-[40%]" src="{{ Storage::url('/website/homepage/icon-payment.svg') }}" alt="icon-payment">
                <div class="card-body lg:pl-0">
                    <h2 class="card-title"><img class="lg:hidden" src="{{ Storage::url('/website/homepage/icon-payment.svg') }}" alt="icon-payment"> Make a payment</h2>
                    <p>We offer a variety of payment options to meet your preferences and ensure a hassle-free
                        transaction process</p>
                </div>
            </div>
            <div class="card w-full flex-col lg:flex-row shadow-xl ">
                <img class="px-8 hidden lg:block self-center h-[40%]" src="{{ Storage::url('/website/homepage/icon-map.svg') }}" alt="icon-map">
                <div class="card-body lg:pl-0">
                    <h2 class="card-title"><img class="lg:hidden" src="{{ Storage::url('/website/homepage/icon-map.svg') }}" alt="icon-map"> Explore & Learn new things</h2>
                    <p>Immerse yourself in captivating sights,sounds,and tastes as you explore ancient streets and learn new things</p>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-16">
        <a class="btn rounded-xl btn-info bg-darkBlue text-white capitalize px-8" href="{{ route('register') }}">
            Register Now
            <img src="{{ Storage::url('/website/homepage/icon-right-arrow.svg') }}" alt="icon-right-arrow">
        </a>
    </div>
</div>









{{-- <div class="font-bold text-2xl text-center mt-20">
    <h2 class="width-auto inline border-b-2 border-secondary p-2">
        Last minute Deals </h2>
</div>
<section class="splide deals-splide mt-10" aria-label="Splide Basic HTML Example">
    <div class="splide__track">
        <ul class="splide__list">
            <li class="splide__slide text-primary">
                <div class="card image-full before:!content-none rounded-lg">
                    <img class="rounded-xl w-full" src="{{ Storage::url('/website/homepage/c-usa.png')}}"/>
                    <div class="card-body p-0">
                        <div class="w-full bg-secondary py-2 text-center text-white text-2xl  font-semibold rounded-t-xl z-40">
                            50% OFF
                        </div>
                        <div class="h-full flex items-end text-white font-semibold text-xl pb-8 ps-6 ">
                            <h4></h4>
                            <p class="w-full p-0 leading-tight	 font-normal">
                                Argentina
                                </br>
                                <span class="text-sm">Nature tours</span>
                                <br>
                                <span class="text-secondary text-sm">2024/Apr/19</span>
                            </p>
                        </div>

                    </div>
                </div>
            </li>
            <li class="splide__slide text-primary">
                <div class="card image-full before:!content-none rounded-lg">
                    <img class="rounded-xl w-full" src="{{ Storage::url('/website/homepage/argentina-l.png') }}"/>
                    <div class="card-body p-0">
                        <div class="w-full bg-secondary py-2 text-center text-white text-2xl  font-semibold rounded-t-xl z-40">
                            50% OFF
                        </div>
                        <div class="h-full flex items-end text-white font-semibold text-xl pb-8 ps-6 ">
                            <h4></h4>
                            <p class="w-full p-0 leading-tight	 font-normal">
                                Argentina
                                </br>
                                <span class="text-sm">Nature tours</span>
                                <br>
                                <span class="text-secondary text-sm">2024/Apr/19</span>
                            </p>
                        </div>

                    </div>
                </div>
            </li>
            <li class="splide__slide text-primary">
                <div class="card image-full before:!content-none rounded-lg">
                    <img class="rounded-xl w-full" src="{{ Storage::url('/website/homepage/colombia.png') }}"/>
                    <div class="card-body p-0">
                        <div class="w-full bg-secondary py-2 text-center text-white text-2xl  font-semibold rounded-t-xl z-40">
                            50% OFF
                        </div>
                        <div class="h-full flex items-end text-white font-semibold text-xl pb-8 ps-6 ">
                            <h4></h4>
                            <p class="w-full p-0 leading-tight	 font-normal">
                                Argentina
                                </br>
                                <span class="text-sm">Nature tours</span>
                                <br>
                                <span class="text-secondary text-sm">2024/Apr/19</span>
                            </p>
                        </div>

                    </div>
                </div>
            </li>
            <li class="splide__slide text-primary">
                <div class="card image-full before:!content-none rounded-lg">
                    <img class="rounded-xl w-full" src="{{ Storage::url('/website/homepage/c-usa.png') }}"/>
                    <div class="card-body p-0">
                        <div class="w-full bg-secondary py-2 text-center text-white text-2xl  font-semibold rounded-t-xl z-40">
                            50% OFF
                        </div>
                        <div class="h-full flex items-end text-white font-semibold text-xl pb-8 ps-6 ">
                            <h4></h4>
                            <p class="w-full p-0 leading-tight	 font-normal">
                                Argentina
                                </br>
                                <span class="text-sm">Nature tours</span>
                                <br>
                                <span class="text-secondary text-sm">2024/Apr/19</span>
                            </p>
                        </div>

                    </div>
                </div>
            </li>
            <li class="splide__slide text-primary">
                <div class="card image-full before:!content-none rounded-lg">
                    <img class="rounded-xl w-full" src="{{ Storage::url('/website/homepage/colombia.png') }}"/>
                    <div class="card-body p-0">
                        <div class="w-full bg-secondary py-2 text-center text-white text-2xl  font-semibold rounded-t-xl z-40">
                            50% OFF
                        </div>
                        <div class="h-full flex items-end text-white font-semibold text-xl pb-8 ps-6 ">
                            <h4></h4>
                            <p class="w-full p-0 leading-tight	 font-normal">
                                Argentina
                                </br>
                                <span class="text-sm">Nature tours</span>
                                <br>
                                <span class="text-secondary text-sm">2024/Apr/19</span>
                            </p>
                        </div>

                    </div>
                </div>
            </li>
        </ul>
    </div>
</section> --}}
