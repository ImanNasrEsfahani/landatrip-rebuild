@includeIf('profile.components.new_post')

@forelse($user->userPosts()->get() as $post)
    <div class="bg-white rounded-4 shadow pb-2 pt-4 mb-4">
    <p class="text-black h6 ps-4 mb-1">{{ $post->title }}</p>
    <div class="d-flex flex-row ps-3 mb-2">
        <img class="text-orange ms-1 me-2" src="{{ asset('/users/location.svg') }}" />
        <p class="text-dark-gray mb-0">{{ $post->location }}</p>
        <span class="text-dark-gray ms-2 me-1">-</span>
        <p class="text-dark-gray pb-0 mb-1">{{ \Carbon\Carbon::create($post->created_at)->diffForHumans() }}</p>
    </div>
    @if($post->contentImage)
            <img class="w-100" src="{{ asset('/posts/' . $post->contentImage?->url) }}" alt="{{ $post->contentImage?->alt }}">
        @else
            <img class="w-100" src="{{ asset('/posts/default.png') }}" alt="{{ $post->contentImage?->alt }}">
        @endif

    @includeIf('profile.components.post-bar')

    <hr class="text-dark-gray w-100 px-3">

    @includeIf('profile.components.post-comments')

</div>
@empty
    <div class="bg-white rounded-4 shadow py-3">
        <div class="w-100 px-4 text-dark-gray">
        {{ __('pages/profile.No Activities are stored until yet') }}
        </div>
    </div>
@endforelse
