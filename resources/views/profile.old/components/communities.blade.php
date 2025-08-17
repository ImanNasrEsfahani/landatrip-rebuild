<div class="bg-white rounded-4 shadow py-3 px-2">
    <h6 class="h5 text-black ms-3 mb-4">{{ __('pages/profile.Communities') }}</h6>
    @forelse($user->communities()->get() as $item)
        <div class="mx-2 rounded-4 shadow p-3 mt-2">
            <a class="d-flex flex-row m-0 p-0 text-decoration-none" href="{{ route("community.show", $item->slug) }}">
                @if($item->thumbnailImage)
                    <img src="{{ asset('/communities/thumbnails/' . $item->thumbnailImage->url ) }}" alt="{{ $item->thumbnailImage->alt }}">
                @else
                    <img class="rounded-3" src="{{ asset('/communities/thumbnails/default.png') }}" alt="Landa trip ">
                @endif
                <span class="d-flex flex-column justify-content-center ms-2">
                <h6 class="fs-2 text-black mb-1">{{ $item->title }}</h6>
                <p class="fs-1 text-dark-gray mb-0"><span class="me-1">{{ $item->users()->count() }}</span>{{ __('pages/profile.followers') }}</p>
            </span>
            </a>
        </div>
    @empty
        <div class="alert alert-danger">
        {{ __("pages/profile.There is'nt any community for you") }}
        </div>
    @endforelse
</div>
