<div class="container mx-auto my-16">
    <div class="w-100 text-center my-10">
        <h2 class="text-h5 text-black border-b-4 border-secondary w-fit d-inline-block mx-auto px-4 py-2">{{ __('pages/articles.last articles') }}</h2>
    </div>
    {{--    @dd($lastArticle)--}}
    <div class="flex flex-col lg:flex-row gap-4 mx-auto">
        <div class="flex flex-col gap-4 relative basis-full md:basis-2/3">
            <div class="bg-white shadow flex flex-col justify-between p-4 rounded-lg col-span-24 lg:col-span-0 w-full lg:w-75 lg:max-w-lg lg:absolute order-2 lg:order-1 top-0 lg:top-1/12 lg:inset-10 lg:-left-14 ">
                <div class="flex items-center mb-3">
                    <a class="text-decoration-none"
                       href="{{ route('profile', $lastArticle->first()->user->slug) }}">
                        <img class="w-20 h-20 rounded-full mr-4 lazyload"
                             data-src="{{ Storage::url('/users/profile/' . $lastArticle->first()->user->profileImage->url) }}"
                             alt="{{ $lastArticle->first()->user->profileImage->alt }}">
                    </a>
                    <div class="flex flex-col flex-grow">
                        <a class="text-decoration-none"
                           href="{{ route('profile', $lastArticle->first()->user->slug) }}">
                            <span class="font-bold text-lg">{{ $lastArticle->first()->user->fname }}{{ $lastArticle->first()->user->lname }}</span>
                        </a>
                        <span class="">{{ $lastArticle->first()->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <div>
                    <a class="text-decoration-none text-black "
                       href="{{ route('blog.show', $lastArticle->first()->slug) }}">
                        <p class="text-xl font-bold my-1">{{ $lastArticle->first()->title }}</p>
                        {!! $lastArticle->first()->description !!}
                    </a>
                </div>
                <div>
                    <p class="text-lightGray">{{ $lastArticle->first()->created_at->format('M d, Y') }}</p>
                </div>
            </div>
            <div class="basis-full p-0 ">
                <img class="w-full h-auto lg:h-full lg:w-full lazyload rounded-lg"
                     data-src="{{ Storage::url('/article/header/' . $lastArticle->first()->headerImage->url) }}"
                     alt="{{ $lastArticle->first()->headerImage->alt }}">
            </div>
        </div>
        <div class="basis-full sm:basis-1/3 flex flex-col justify-between">
            @forelse($lastArticle as  $article)
                <div class="flex gap-x-1 items-center shadow rounded-lg">
                    <a class="basis-2/5 text-decoration-none text-black text-lg"
                       href="{{ route('blog.show', $article->slug) }}">
                        <img class="w-36 h-36 rounded-lg flex-grow-0 my-2  lazyload"
                             data-src="{{ Storage::url('/article/thumbnail/' . $article->profileImage->url) }}"
                             alt="{{ $article->profileImage->alt }}">
                    </a>
                    <div class="basis-3/5 flex flex-col justify-between flex-grow">
                        <a class="text-decoration-none text-black" href="{{ route('blog.show', $article->slug) }}">
                            <p class="mb-2 text-lg font-bold ">{{ $article->title }}</p>
                        </a>
                        <div class="flex flex-row">
                            <a class="text-decoration-none" href="{{ route('profile', $article->user->slug) }}">
                                <img class="w-10 h-10 rounded-full mr-4 lazyload"
                                     data-src="{{ Storage::url('/users/profile/' . $article->user->profileImage->url) }}"
                                     alt="{{ $article->user->profileImage->alt }}">
                            </a>
                            <div class="flex flex-col p-1">
                                <a class="text-decoration-none"
                                   href="{{ route('profile', $article->user->slug) }}">
                                    <p class="flex-grow text-sm text-black font-bold mb-4">{{ $article->user->fname }}{{ $article->user->lname }}</p>
                                </a>
                                <p class="text-xs">{{ $article->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <span class="bg-orange rounded-full text-white px-3 w-[max-content] font-light"># {{ $article->articleCategory->title }}</span>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>


    {{--    <div class="row gy-4 mx-auto">--}}
    {{--        <div class="row gy-2 mx-auto col-24 col-xl-16 position-relative">--}}
    {{--            <div class="bg-white shadow d-flex flex-column p-4 rounded-4 col-24 col-lg-0 w-100 mw-lg-75 position-lg-absolute order-2 order-lg-1 top-0 top-lg-50 start-n-5 translate-middle-lg-y">--}}
    {{--                <div class="d-flex align-items-center mb-3">--}}
    {{--                    <a class="text-decoration-none" href="{{ route("profile.show", $lastArticle->first()->user->slug) }}">--}}
    {{--                    <img class="max-w-5rem rounded-pill me-4 lazyload" data-src="{{ asset("/users/profile/". $lastArticle->first()->user->profileImage->url) }}" alt="{{ $lastArticle->first()->user->profileImage->alt }}">--}}
    {{--                    </a>--}}
    {{--                    <div class="d-flex flex-column flex-grow-1">--}}
    {{--                        <a class="text-decoration-none" href="{{ route("profile.show", $lastArticle->first()->user->slug) }}">--}}
    {{--                        <span class="fw-bold fs-4 text-secondary">{{ $lastArticle->first()->user->fname. $lastArticle->first()->user->lname }}</span>--}}
    {{--                        </a>--}}
    {{--                        <span class="text-secondary">{{ $lastArticle->first()->created_at->diffForHumans() }}</span>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div>--}}
    {{--                    <a class="text-decoration-none text-black" href="{{ route('blog.show', $lastArticle->first()->slug) }}">--}}
    {{--                    <h2>{{ $lastArticle->first()->title }}</h2>--}}
    {{--                    {!! $lastArticle->first()->description !!}--}}
    {{--                    <span class="text-secondary">{{ $lastArticle->first()->created_at->format("M d, Y") }}</span>--}}
    {{--                    </a>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="col-24 p-0 overflow-hidden rounded-4 max-vh-70">--}}
    {{--                <img class="h-100 w-100 h-xl-auto w-xl-100 lazyload" data-src="{{asset("/article/header/". $lastArticle->first()->headerImage->url)}}" alt="{{ $lastArticle->first()->headerImage->alt }}">--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <div class="col-24 col-xl-8 d-flex flex-column justify-content-between mt-4">--}}
    {{--            @forelse($lastArticle as  $article)--}}
    {{--                <div class="d-flex w-100 shadow rounded-4 mb-2">--}}
    {{--                    <a class="text-decoration-none text-black" href="{{ route('blog.show', $article->slug) }}">--}}
    {{--                    <img class="rounded-4 max-w-9rem flex-grow-0 my-2 ms-3 lazyload" data-src="{{ asset("/article/thumbnail/". $article->profileImage->url) }}" alt="{{ $article->profileImage->al }}">--}}
    {{--                    </a>--}}
    {{--                    <div class="d-flex flex-column justify-content-between flex-grow-1 ms-3 my-2">--}}
    {{--                        <a class="text-decoration-none text-black" href="{{ route('blog.show', $article->slug) }}">--}}
    {{--                        <h3 class="w-100 mb-2 fs-4">{{ $article->title }}</h3>--}}
    {{--                        </a>--}}
    {{--                        <div class="d-flex flex-row mb-2">--}}
    {{--                            <a class="text-decoration-none" href="{{ route("profile.show", $article->user->slug) }}">--}}
    {{--                                <img class="max-w-3rem rounded-pill me-4 lazyload" data-src="{{ asset("/users/profile/". $article->user->profileImage->url) }}" alt="{{ $article->user->profileImage->alt }}">--}}
    {{--                            </a>--}}
    {{--                            <div class="d-flex flex-column">--}}
    {{--                                <a class="text-decoration-none" href="{{ route("profile.show", $article->user->slug) }}">--}}
    {{--                                <span class="fw-bold flex-grow-1 text-secondary fs-2">{{ $article->user->fname. $article->user->lname }}</span>--}}
    {{--                                </a>--}}
    {{--                                <span class="text-secondary fs-2">{{ $article->created_at->diffForHumans() }}</span>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <span class="badge bg-orange rounded-pill text-white w-fit fw-light px-3"># {{ $article->articleCategory->title }}</span>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            @empty--}}
    {{--            @endforelse--}}
    {{--        </div>--}}
    {{--    </div>--}}
</div>

