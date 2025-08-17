<div class="container mx-auto mt-15 mb-10">
    <div class="w-100 text-center mb-4">
        <h2 class="h3 RobotoSlab-font-family text-black title-underline d-inline-block mx-auto px-4 py-2">{{ __('pages/articles.Top Creator') }}</h2>
    </div>
    <div class="row justify-content-evenly gy-4">
        @forelse($lastArticle as $article)
            <div class="d-flex col-24 col-md-9 col-lg-8 justify-content-center">
                <img class="rounded-pill max-w-4rem w-auto lazyload" data-src="{{ asset("/users/profile/". $article->user->profileImage->url) }}" alt="{{ $article->user->profileImage->alt }}">
                <div class="d-flex flex-column ms-3 justify-content-evenly">
                    <span class="text-dark fs-4 fw-bold">{{ $article->user->fname. $article->user->lname }}</span>
                    <span class="text-secondary">{{ $article->user->title }}</span>
                </div>
            </div>
            @empty
        @endforelse
    </div>
</div>
