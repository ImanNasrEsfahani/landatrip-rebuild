<div class="container mx-auto my-32 text-black">
    <div class="flex flex-col justify-between lg:flex-row gap-y-5">
        <div>
            <div>
                <p class="text-xl my-2 text-[#4F4F4F] text-center lg:text-left">Last minute tours </p>
            </div>
            <div>
                <p class="my-2 text-4xl text-center lg:text-left">With Unbelievable Discount</p>
            </div>
        </div>
        <div class="">
            <p class="text-base text-center lg:text-left ">Our educational destinations offer an unrivaled blend <br />
                of natural beauty and
                cultural richness </p>
        </div>
    </div>
    <div class="my-16">
        {{-- <section id="project" class="splide" aria-labelledby="carousel-heading">
            <h2 id="carousel-heading">Splide Basic HTML Example</h2>
            <div class="splide__track">
                  <ul class="splide__list">
                      <li class="splide__slide">Slide 01</li>
                      <li class="splide__slide">Slide 02</li>
                      <li class="splide__slide">Slide 03</li>
                  </ul>
            </div>
          </section> --}}
        <div class="splide" id="deals-splide">
            <div class="splide__track ">
                <ul class="splide__list ">
                    @forelse($upComingTours as $deal)
                        <li class="justify-center mx-10 splide__slide place-items-center relative">
                            <a href="{{ route('tour.show', $deal->tour->slug) }}#group-cards" class="after:absolute after:inset-0">
                            <div class="card visible bg-base-100 shadow-xl image-full before:!content-none">
                                <picture class="">
                                    <source class="" media="(min-width: )"
                                        src="{{ Storage::url('/courses/thumbnail/'. $deal->tour->thumbnailImage->url) }}" alt="deal1">
                                    <img class="rounded-lg w-full object-cover" src="{{ Storage::url('/courses/thumbnail/'. $deal->tour->thumbnailImage->url) }}"
                                        alt="deal1">
                                </picture>
                                <div class="flex justify-between p-3 card-body">
                                    <div class="flex flex-row justify-between">
                                        <div
                                            class="px-5 py-3 text-white rounded-xl bg-white/10 backdrop-opacity-90 backdrop-blur-xl">
                                            <p class="text-sm text-black ">{{ $deal->end_registration_date->diffForHumans() }}</p>
                                        </div>
                                        <img class="self-center p-3 card-actions"
                                            src="{{ Storage::url('/website/homepage/icon-heart.svg') }}"
                                            alt="icon-heart-fill">
                                    </div>
                                    <div>
                                        <div
                                            class="px-5 py-3 text-white rounded-xl bg-white/10 backdrop-opacity-90 backdrop-blur-xl">
                                            <div>
                                                <p class="text-sm md:text-lg text-black">{{ $deal->start_date_tour->format('d F') }}-{{ $deal->end_date_tour->format('d F') }}</p>
                                            </div>
                                            <div class="py-1">
                                                <p class="text-sm md:text-lg text-black line-clamp-1">{{ $deal->title }}</p>
                                            </div>
                                            <div class="flex justify-between text-lg md:text-xl">
                                                <span class="text-black text-sm">{{ $deal->tour->city->name }}</span>
                                                <span class="text-black text-sm">${{ rand(100,1000) }} </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </a>
                        </li>
                    @empty
                        <p>No Deals Right Now</p>
                    @endforelse
                </ul>
            </div>
        </div>
        {{--        <div class="mt-10 text-center"> --}}
        {{--            <button class="text-white capitalize bg-black btn rounded-xl btn-info"> --}}
        {{--                More Tours --}}
        {{--                <img src="{{ Storage::url('/website/homepage/icon-right-arrow.svg') }}" alt="icon-right-arrow"> --}}
        {{--            </button> --}}
        {{--        </div> --}}
    </div>
</div>







{{-- <div class="mt-20 text-2xl font-bold text-center">
    <h2 class="inline p-2 border-b-2 width-auto border-secondary">
        which one is you </h2>
</div>

<div class="flex flex-col justify-center m-10 md:flex-row">
    <div class="card image-full before:!content-none rounded-lg lg:p-2 p-6 md:w-auto w-full mt-6">
        <img class="object-fill w-full h-full rounded-lg"
             src="{{ Storage::url('/website/homepage/teacher.png') }}">
        <div class="card-body">
            <div class="flex items-end justify-center w-full h-full font-semibold text-center ">
                <button class="bg-secondary lg:px-6 md:px-1.5 px-6 py-1.5 rounded-full text-white">
                    Register now
                </button>
            </div>
        </div>
    </div>

    <div class=" card image-full before:!content-none rounded-lg lg:p-2 p-6 mt-6">
        <img class="object-fill w-full h-full rounded-lg"
             src="{{  Storage::url('/website/homepage/student.png') }}">
        <div class="card-body">
            <div class="flex items-end justify-center w-full h-full font-semibold text-center ">
                <button class="bg-secondary lg:px-6 md:px-1.5 px-6 py-1.5 rounded-full text-white">
                    Register now
                </button>
            </div>
        </div>
    </div>
</div> --}}









{{-- <div class="grid grid-cols-2 mt-10 text-lg font-bold text-center ">
    <a href="">
        <div class="bg-[#EAEEF3] p-4 border-e border-accent rounded-l-lg">
            Location
        </div>
    </a>
    <a href="">
        <div class="bg-[#EAEEF3] p-4 rounded-r-lg">
            Skills
        </div>
    </a>
</div>
<div class="grid grid-cols-2 mt-6 text-base font-semibold text-center lg:grid-cols-5 md:grid-cols-3">
    <div>
        <button
                class="md:w-40 w-32 bg-white text-secondary my-2 border-2 border-secondary py-1.5 rounded-lg hover:bg-secondary hover:text-white duration-300">
            America
        </button>
    </div>

    <div>
        <button
                class="md:w-40 w-32 bg-white text-secondary my-2 border-2 border-secondary py-1.5 rounded-lg hover:bg-secondary hover:text-white duration-300">
            Asia
        </button>
    </div>

    <div>
        <button
                class="md:w-40 w-32 bg-white text-secondary my-2 border-2 border-secondary py-1.5 rounded-lg hover:bg-secondary hover:text-white duration-300">
            Europe
        </button>
    </div>

    <div>
        <button
                class="md:w-40 w-32 bg-white text-secondary my-2 border-2 border-secondary py-1.5 rounded-lg hover:bg-secondary hover:text-white duration-300">
            Africa
        </button>
    </div>

    <div class="col-span-2 md:col-span-1">
        <button
                class="md:w-40 w-32 bg-white text-secondary my-2 border-2 border-secondary py-1.5 rounded-lg hover:bg-secondary hover:text-white duration-300">
            Australia
        </button>
    </div>

</div>
<div class="px-4 py-2 mt-8 border-s-4 border-primary">
    <h2 class="text-xl font-semibold lg:text-3xl md:text-3xl">TOP TRAVEL DESTINATIONS IN AMERICA</h2>
    <h6 class="text-base font-normal text-accent">Top Most Beautiful Places in America You Must Visit Before You Leave
        <America></America>
    </h6>
</div>

<section class="mt-10 splide top-travel-splide" aria-label="Splide Basic HTML Example">
    <div class="splide__track">
        <ul class="splide__list">
            <li class="splide__slide text-primary">
                <div class="card image-full before:!content-none rounded-lg">
                    <img class="w-full rounded-xl" src="{{ Storage::url('/website/homepage/c-usa.png') }}"/>
                    <div class="p-0 card-body">
                        <div class="flex items-end h-full pb-8 text-xl font-semibold text-white ps-6 ">
                            <h4></h4>
                            <p class="w-full p-0 font-normal leading-tight">
                                North America
                                </br>
                                <span class="text-sm">Desert tour</span>
                                <br>
                                <span class="text-sm text-secondary">2024/jun/08</span>
                            </p>
                        </div>

                    </div>
                </div>
            </li>
            <li class="splide__slide text-primary">
                <div class="card image-full before:!content-none rounded-lg">
                    <img class="w-full rounded-xl" src="{{ Storage::url('/website/homepage/c-usa.png') }}"/>
                    <div class="p-0 card-body">
                        <div class="flex items-end h-full pb-8 text-xl font-semibold text-white ps-6 ">
                            <h4></h4>
                            <p class="w-full p-0 font-normal leading-tight">
                                North America
                                </br>
                                <span class="text-sm">Desert tour</span>
                                <br>
                                <span class="text-sm text-secondary">2024/jun/08</span>
                            </p>
                        </div>

                    </div>
                </div>
            </li>
            <li class="splide__slide text-primary">
                <div class="card image-full before:!content-none rounded-lg">
                    <img class="w-full rounded-xl" src="{{ Storage::url('/website/homepage/c-usa.png') }}"/>
                    <div class="p-0 card-body">
                        <div class="flex items-end h-full pb-8 text-xl font-semibold text-white ps-6 ">
                            <h4></h4>
                            <p class="w-full p-0 font-normal leading-tight">
                                North America
                                </br>
                                <span class="text-sm">Desert tour</span>
                                <br>
                                <span class="text-sm text-secondary">2024/jun/08</span>
                            </p>
                        </div>

                    </div>
                </div>
            </li>
            <li class="splide__slide text-primary">
                <div class="card image-full before:!content-none rounded-lg">
                    <img class="w-full rounded-xl" src="{{ Storage::url('/website/homepage/c-usa.png') }}"/>
                    <div class="p-0 card-body">
                        <div class="flex items-end h-full pb-8 text-xl font-semibold text-white ps-6 ">
                            <h4></h4>
                            <p class="w-full p-0 font-normal leading-tight">
                                North America
                                </br>
                                <span class="text-sm">Desert tour</span>
                                <br>
                                <span class="text-sm text-secondary">2024/jun/08</span>
                            </p>
                        </div>

                    </div>
                </div>
            </li>
            <li class="splide__slide text-primary">
                <div class="card image-full before:!content-none rounded-lg">
                    <img class="w-full rounded-xl" src="{{ Storage::url('/website/homepage/c-usa.png') }}"/>

                    <div class="p-0 card-body">

                        <div class="flex items-end h-full pb-8 text-xl font-semibold text-white ps-6 ">
                            <h4></h4>
                            <p class="w-full p-0 font-normal leading-tight">
                                North America
                                </br>
                                <span class="text-sm">Desert tour</span>
                                <br>
                                <span class="text-sm text-secondary">2024/jun/08</span>
                            </p>
                        </div>

                    </div>
                </div>
            </li>
        </ul>
    </div>
</section> --}}
