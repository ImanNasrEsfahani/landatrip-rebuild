<div class="container mx-auto my-15 mb-10">
    <div class="w-100 text-center my-10">
        <h2 class="text-h5 RobotoSlab-font-family text-black title-underline  border-b-4 border-secondary w-fit inline-block mx-auto px-4 py-2">{{ __('pages/articles.Popular Articles') }}</h2>
    </div>
    <div class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 ">
        @forelse($lastArticle as $article)
            <div class="">
                <div class="h-full flex flex-col justify-between shadow p-3 rounded-lg">
                    <a class="text-decoration-none text-black" href="{{ route('blog.show', $article->slug) }}">
                        <img class="rounded-lg w-full max-h-16rem mb-4 lazyload"
                             data-src="{{ Storage::url("/article/thumbnail/". $article->profileImage->url) }}"
                             alt="{{ $article->profileImage->alt }}">
                        <h3 class="min-h-5rem text-lg font-bold my-3">{{ $article->title }}</h3>
                        <p class="flex-grow-1">{{ $article->description }}</p>
                    </a>
                    <div class="flex flex-row my-3">
                        <a class="text-decoration-none" href="{{ route("profile", $article->user->slug) }}">
                            <img class="w-14 rounded-full me-4 lazylaod"
                                 data-src="{{ Storage::url("/users/profile/". $article->user->profileImage->url) }}"
                                 src="{{ Storage::url("/users/profile/". $article->user->profileImage->url) }}"
                                 alt="{{ $article->user->profileImage->alt }}">
                        </a>
                        <div class="d-flex flex-column items-center">
                            <a class="text-decoration-none" href="{{ route("profile", $article->user->slug) }}">
                                <span class="text-sm font-bold mb-1">{{ $article->user->fname. $article->user->lname }}</span>
                            </a>
                            <p class="text-xs">{{ $article->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        @endforelse
    </div>
</div>
