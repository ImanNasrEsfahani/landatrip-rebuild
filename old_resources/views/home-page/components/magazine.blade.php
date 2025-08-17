<div class="my-20 container mx-auto text-black">

    <div class="grid grid-cols-1 lg:grid-cols-5">
        <div class="lg:col-span-3 self-start	">
            <div>
                <p class="text-xl text-[#4F4F4F] text-center lg:text-left">Follow latest news in</p>
            </div>
            <div class="my-4">
                <p class="text-4xl text-black text-center lg:text-left">Our Informative Magazine</p>
            </div>
            <div class="my-4">
                <p class="text-xl text-center lg:text-left">Discover the latest travel trends and tour tips on our online
                    magazine.</p>
            </div>
            <div >
                <a href="{{ route("blog.index") }}" class="btn rounded-xl btn-info my-7 bg-darkBlue text-white capitalize px-8">
                    View More
                    <img class="object-cover " src="{{ Storage::url('/website/homepage/icon-right-arrow.svg') }}" alt="icon-right-arrow">
                </a>
            </div>
        </div>
        <div class="flex flex-col lg:col-span-2 gap-y-2">
            @forelse($articles as $article)
                <div class="py-10 lg:border-b relative">
                    <div class="card grid grid-cols-1 md:grid-cols-2 lg:card-side shadow-xl lg:shadow-none">
                        <picture class="col-span-1">
                            <source class="md:w-[15rem] w-full aspect-video rounded-lg" media="(min-width: )"
                                src="{{ Storage::url('/article/thumbnail/'. $article->profileImage->url) }}" alt="magazine1">
                            <img class="md:w-[15rem] w-full aspect-video rounded-lg object-cover" src="{{ Storage::url('/article/thumbnail/'. $article->profileImage->url) }}"
                                alt="magazine1">
                        </picture>
                        <div class="card-body col-span-1 font-bold px-5 lg:py-1 py-5 mt-2 lg:my-0">
                            <h3 class="font-bold text-center lg:text-start">{{ $article->title }}</h3>
                            <span class="badge badge-primary text-white font-normal self-center lg:self-start justify-items-center text-center">{{ $article->articleCategory->title }}</span>
                        </div>
                    </div>
                    <a href="{{ route("blog.show", $article->slug) }}" class="after:absolute after:inset-0"></a>
                </div>
            @empty
                <p>asghar</p>
            @endforelse
        </div>
    </div>

</div>
