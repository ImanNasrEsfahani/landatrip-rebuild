<div class="bg-white rounded-4 shadow pt-4 pb-4 px-1 mb-3">
    <h6 class="h5 text-black ms-3 mb-1">{{ __('pages/profile.Groups') }}</h6>
    @forelse($user->groups()->get() as $item)
        <a href="{{ route("group.show", $item->slug) }}" class="d-flex flex-row text-decoration-none m-0 mt-2 p-0">
            <div class="w-100 mx-3 d-flex flex-row rounded-4 shadow p-2 mt-2">
                @if($item->thumbnailImage)
                    <img class="h-100 max-w-5rem rounded-3" src="{{ asset('/groups/thumbnails/' . $item->thumbnailImage->url ) }}" alt="{{ $item->thumbnailImage->alt }}">
                @else
                    <img class="h-100 max-w-5rem rounded-3" src="{{ asset('/groups/thumbnails/default.png' ) }}" alt="Landa trip group">
                @endif

                <span class="d-flex flex-column justify-content-around ms-3">
                <h6 class="fs-2 text-black text-center lh-base mb-0">{{ $item->title }}</h6>
                    @auth
                        @if($item->users()->where("user_id", "=", auth()->user()->id)->count())
                            <p class="fs-1 mb-0 text-green">{{ __('pages/profile.Classmates') }}</p>
                        @else
                            <p class="fs-1 mb-0 text-danger">{{ __('pages/profile.Not Classmates') }}</p>
                        @endif
                    @endAuth
            </span>
            </div>
        </a>
    @empty
        <div class="alert alert-danger">
        {{ __("pages/profile.There is'nt any group for you") }}
        </div>
    @endforelse
</div>
