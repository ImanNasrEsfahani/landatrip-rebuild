@php use Illuminate\Support\Facades\Storage; @endphp
<div class="lg:m-5">
    <div class="relative h-[130vh] md:h-[95vh]">
        <div class="absolute -z-10 h-full w-full lg:max-w-full p-5 lg:rounded-2xl bg-cover bg-center bg-no-repeat"
             style="background-image: url({{ Storage::url("/article/header/" . $article->headerImage->url) }}) "></div>
    </div>
    <div class="container mx-auto flex flex-col lg:flex-row gap-x-14 my-8">
        <div class="basis-full lg:basis-3/4">
            <div class="my-10">
                <ul class="list-disc">
                    <li>
                        <span >{{ $article->articleCategory->title }}</span>
                    </li>
                </ul>
            </div>
            <div>
                <h1 class="text-2xl font-bold my-5">{{ $article->title }}</h1>
            </div>
            {!! $article->body !!}
        </div>
        <div class="basis-full lg:basis-1/4 md:ms-10 ms-0 mt-10">
            <div class="flex flex-col items-center">
                <h5 class="font-bold text-black inline-block mx-auto px-4 py-2">{{ __('pages/articles.author') }}</h5>
                <div class="text-center relative">
                    <a class="stretched-link" href="{{ route("profile", $article->user->slug) }}"></a>
                    <img class="rounded-full mx-auto w-32 my-5 lazyload"
                         data-src="{{ Storage::url("/users/profile/" . $article->user->profileImage->url) }}"
                         alt="{{ $article->user->profileImage->alt }}">
                    <div class="flex flex-col ms-3 items-center">
                        <h3 class="text-dark text-2xl font-semibold mb-5">{{ $article->user->fname . " " . $article->user->lname }}</h3>
                    </div>
                </div>
                <p class="text-center">{{ $article->user->about_me }}</p>
                {{--                social media--}}
                {{--                <div class="w-full flex justify-center w-fit bg-secondary rounded-lg">--}}
                {{--                    @forelse($article->user->socialMedia as $item)--}}
                {{--                        <a class="text-decoration-none badge" href="{{ $item->pivot->address }}">--}}
                {{--                            <img src="{{Storage::url("/website/blog/facebook.png")}}">--}}
                {{--                        </a>--}}
                {{--                    @empty--}}
                {{--                    @endforelse--}}
                {{--                </div>--}}
            </div>
            <div class="flex flex-col ms-3 items-center mt-8 mt-lg-10 mt-xl-12">
                <div class="w-full text-center my-5">
                    <h5 class="text-2xl font-bold text-black border-b-4 border-secondary inline-block mx-auto px-4 py-2">{{ __('pages/articles.for you') }}</h5>
                </div>
            </div>
            <div class="flex flex-row items-center space-y-5 space-y-lg-0 sticky top-0">
                <div class="w-full xl:w-14/24">
                    <div class="h-full flex flex-col justify-between shadow p-3 rounded-lg gap-y-5">
                        <a class="text-decoration-none text-black" href="{{ route('blog.show', $nextArticle->slug) }}">
                            <img class="rounded-4 w-full max-h-16rem mb-4 lazyload rounded-lg"
                                 data-src="{{ Storage::url("/article/thumbnail/" . $nextArticle->profileImage->url) }}"
                                 alt="{{ $nextArticle->profileImage->alt }}">
                            <h5 class="mt-3">{{ $nextArticle->title }}</h5>
                            <p class="flex-grow-1">{{ $nextArticle->description }}</p>
                        </a>
                        <div class="flex flex-row my-5">
                            <a class="text-decoration-none "
                               href="{{ route("profile", $nextArticle->user->slug) }}">
                                <img class="w-14 rounded-full me-4 lazyload "
                                     data-src="{{ Storage::url("/users/profile/" . $nextArticle->user->profileImage->url) }}"
                                     alt="{{ $nextArticle->user->profileImage->alt }}">
                            </a>
                            <div class="flex flex-col">
                                <a class="text-decoration-none"
                                   href="{{ route("profile", $nextArticle->user->slug) }}">
                                    <span class="font-semibold flex-grow-1 text-sm mb-2">{{ $nextArticle->user->fname . $nextArticle->user->lname }}</span>
                                </a>
                                <span class="text-xs ">{{ $nextArticle->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
