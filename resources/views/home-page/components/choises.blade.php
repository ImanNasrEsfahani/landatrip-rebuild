@unless($tours == null)
    <div class="container mx-auto my-32 text-black">
        <div class="flex flex-col justify-between lg:flex-row gap-y-5">
            <div>
{{--                <div>--}}
{{--                    <p class="text-xl my-2 text-[#4F4F4F] text-center lg:text-left">Best Groups By Travelers' Choice</p>--}}
{{--                </div>--}}
                <div>
                    <p class="my-2 text-4xl text-center lg:text-left font-semibold">Traveler-Approved Groups</p>
                </div>
            </div>
            <div class="self-center lg:self-end">
                <p class="text-xl text-center lg:text-left">Explore unknown destinations and <br>learn new skills from top educators</p>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-5 my-16 lg:grid-cols-3">
            <div class="relative col-span-1 lg:col-span-2">
                <picture class="relative w-full h-full">
                    <source class="relative w-full h-full" media="(min-width: )"
                        src="{{ Storage::url('/website/homepage/' . $tours[0]->headerImage->url) }}" alt="choice1">
                    <img class="relative w-full h-full rounded-lg object-cover"
                        src="{{ Storage::url('/courses/header/' . $tours[0]->headerImage->url) }}" alt="choice1">
                </picture>
                <div class="absolute bottom-[8%] left-[3%] max-w-[95%] py-2 px-4 md:py-5 md:px-7 rounded-xl text-white bg-white/10 backdrop-opacity-90 backdrop-blur-3xl  overflow-x-hidden">
                    <h3 class="text-sm lg:text-xl line-clamp-1">{{ $tours[0]->title }}</h3>
                    <p class="text-xs lg:text-sm">{{ $tours[0]->city->country->name }}</p>
                </div>
                <a href="{{ route('tour.show', $tours[0]->slug) }}" class="after:absolute after:inset-0"></a>
            </div>
            <div class="relative col-span-1 lg:col-span-1">
                <picture class="relative w-full h-full">
                    <source class="relative w-full h-full" media="(min-width: )"
                        src="{{ Storage::url('/courses/header/' . $tours[1]->thumbnailImage->url) }}" alt="choice1">
                    <img class="relative w-full h-full rounded-lg object-cover"
                        src="{{ Storage::url('/courses/header/' . $tours[1]->thumbnailImage->url) }}" alt="choice1">
                </picture>
                <div class="absolute bottom-[8%] left-[4%] md:w-[50%] max-w-[95%] py-2 px-4 md:py-5 md:px-7 rounded-xl text-white bg-white/10 backdrop-opacity-90 backdrop-blur-3xl  overflow-x-hidden">
                    <h3 class="text-sm lg:text-xl line-clamp-1">{{ $tours[1]->title }}</h3>
                    <p class="text-xs lg:text-sm">{{ $tours[1]->city->country->name }}</p>
                </div>
                <a href="{{ route('tour.show', $tours[1]->slug) }}" class="after:absolute after:inset-0"></a>
            </div>
            <div class="relative col-span-1 lg:col-span-1">
                <picture class="relative w-full h-full">
                    <source class="w-full h-full" media="(min-width: )"
                        src="{{ Storage::url('/courses/header/' . $tours[2]->headerImage->url) }}" alt="choice1">
                    <img class="relative w-full h-full rounded-lg object-cover"
                        src="{{ Storage::url('/courses/header/' . $tours[2]->headerImage->url) }}" alt="choice1">
                </picture>
                <div class="absolute bottom-[8%] left-[4%] md:w-[50%] max-w-[95%] py-2 px-4 md:py-5 md:px-7 rounded-xl text-white bg-white/10 backdrop-opacity-90 backdrop-blur-3xl  overflow-x-hidden">
                    <h3 class="text-sm lg:text-xl line-clamp-1">{{ $tours[2]->title }}</h3>
                    <p class="text-xs lg:text-sm">{{ $tours[2]->city->country->name }}</p>
                </div>
                <a href="{{ route('tour.show', $tours[2]->slug) }}" class="after:absolute after:inset-0"></a>

            </div>
            <div class="relative col-span-1 lg:col-span-2">
                <picture class="relative w-full h-full">
                    <source class="w-full h-full" media="(min-width: )"
                        src="{{ Storage::url('/courses/header/' . $tours[3]->thumbnailImage->url) }}" alt="choice1">
                    <img class="relative w-full h-full rounded-lg object-cover"
                        src="{{ Storage::url('/courses/header/' . $tours[3]->thumbnailImage->url) }}" alt="choice1">
                </picture>
                <div class="absolute bottom-[8%] left-[3%] max-w-[95%] py-2 px-4 md:py-5 md:px-7 rounded-xl text-white bg-white/10 backdrop-opacity-90 backdrop-blur-3xl  overflow-x-hidden">
                    <h3 class="text-sm lg:text-xl line-clamp-1">{{ $tours[3]->title }}</h3>
                    <p class="text-xs lg:text-sm">{{ $tours[3]->city->country->name }}</p>
                </div>
                <a href="{{ route('tour.show', $tours[3]->slug) }}" class="after:absolute after:inset-0"></a>
            </div>
        </div>
    </div>
@else
    <p>No Tours Right Now</p>
@endunless






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
