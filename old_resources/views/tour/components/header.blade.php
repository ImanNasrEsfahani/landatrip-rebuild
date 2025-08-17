{{--<header class="p-2">--}}
{{--    <div class="relative">--}}
{{--        <picture class="w-full relative">--}}
{{--            <source class="w-full" media="(min-width: )"--}}
{{--                    src="{{ Storage::url('/website/tours/'. $tour->headerImage->url) }}" alt="hero">--}}
{{--            <img  class="w-full h-[65vh] md:h-[98vh] lg:rounded-2xl bg-cover" src="{{ Storage::url('/courses/header/'. $tour->headerImage->url) }}"--}}
{{--                 alt="hero-homepage-desktop">--}}
{{--        </picture>--}}

<header class="lg:m-5">
    <div class="relative h-[95vh]">
        <div class="absolute -z-10 h-full w-full lg:max-w-full p-5 lg:rounded-2xl bg-cover bg-center bg-no-repeat"
             style="background-image: url({{ Storage::url('/courses/header/'. $tour->headerImage->url)  }})"></div>
        <div class="hidden md:block absolute top-[40%] left-[50%] overflow-x-hidden bg-white bg-opacity-80 backdrop-blur p-5 rounded-3xl text-center w-9/12 lg:w-auto"
             style="transform: translate(-50%, -50%)">
            <p class="text-4xl font-bold mb-5 leading-normal">{{$tour->title}}</p>
            <p class="text-xl font-bold">{{$tour->short_summary}}</p>
        </div>
        <div class="container hidden md:block absolute bottom-[5%] left-[50%] overflow-x-hidden "
             style="transform: translate(-50%, -50%)">
            <div class="join rounded-3xl shadow-inner shadow-white/40 w-full py-2 bg-white bg-opacity-80 backdrop-blur">
                <div class="flex justify-between w-full ">
                    <div class="flex  gap-x-3  join-item py-3 text-black items-center w-full lg:w-1/5 border-r border-black justify-center items-center">
                        <img src="{{ Storage::url('/website/tours/location.svg')}}">
                        <span class="capitalize text-body2 font-bold">{{ $tour->city->name }}, {{ $tour->city->country->name }}</span>
                    </div>
                    <div class="flex  gap-x-3  join-item py-3 text-black items-center w-full lg:w-1/5 border-r border-black justify-center items-center">
                        <img src="{{ Storage::url('/website/tours/sun.svg')}}">
                        <h3 class="inline-block text-body2 font-bold">{{ $lastGroup->days }} {{ __('pages/tour-lang.days') }}
                            ,{{ $lastGroup->nights }} {{ __('pages/tour-lang.nights') }}</h3>
                    </div>
                    <div class="flex  gap-x-3  join-item py-3 text-black items-center w-full lg:w-1/5 border-r border-black justify-center items-center">
                        <img src="{{ Storage::url('/website/tours/teacher.svg')}}">
                        <h3 class="inline-block text-body2 font-bold">{{ $tour->skills }}</h3>
                    </div>
                    <div class="flex  gap-x-3  join-item py-3 text-black items-center w-full lg:w-1/5 border-r border-black justify-center items-center">

                        <img src="{{ Storage::url('/website/tours/people.svg')}}">
                        <h3 class="inline-block text-body2 font-bold">8-14 people</h3>
                    </div>
                    <div class="flex  gap-x-3  join-item py-3 text-black items-center w-full lg:w-1/5 justify-center items-center">

                        <img src="{{ Storage::url('/website/tours/medal.svg')}}">
                        <h3 class="inline-block text-body2 font-bold">4.1/5 (12 comments)</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
