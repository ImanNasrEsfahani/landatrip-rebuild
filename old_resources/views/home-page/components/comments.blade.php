    <div class="bg-[#272A3A] my-20">
    <div class="container px-10 py-20 mx-auto">
        <div  id="comment-carousel" class="flex flex-col justify-between splide">
            <div class="flex flex-row justify-between">
                <div>
                    <p class="text-4xl text-center text-white lg:text-left">What our customers are saying</p>
                </div>
                <div class="hidden lg:flex splide__arrows">
                    <div class="self-center mx-1 mb-10 splide__arrow splide__arrow--prev contents">
                        <img class="mx-2" src="{{ Storage::url('/website/homepage/icon-left-arrow-comment.svg') }}"
                            alt="icon-left-arrow-comment">
                    </div>
                    <div class="self-center mx-1 mb-10 splide__arrow splide__arrow--next contents">
                        <img class="mx-2" src="{{ Storage::url('/website/homepage/icon-right-arrow-comment.svg') }}"
                            alt="icon-right-arrow-comment">
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-y-5 lg:flex-row mt-20 ">
                <div class="splide__track">
                    <ul class="splide__list">
                        @forelse($comments as $comment)
                            <li class="flex flex-col lg:flex-row splide__slide">
                                <picture class="self-center">
                                    <source class="rounded-full aspect-square w-[12rem]" media="(min-width: )"
                                        src="{{ Storage::url('/users/profile/'. $comment->user->profileImage->url) }}" alt="avatar-comment">
                                    <img class="rounded-full aspect-square w-[12rem]" src="{{ Storage::url('/users/profile/'. $comment->user->profileImage->url) }}"
                                        alt="avatar-comment">
                                </picture>
                                <div class="flex flex-col m-10 text-white justify-evenly">
                                    <div>
                                        <p class="text-justify">{{ $comment->comment }}</p>
                                    </div>
                                    <div class="my-2">
                                        <p>{{ $comment->user->fname }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[#B9B9B9]">{{ $comment->user->title }}</p>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <p>asghar</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
