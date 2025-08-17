<div class="w-100 py-3 px-3 mt-3 mb-2 shadow bg-white rounded-3 text-start">
    <p class="mb-0"><b>Related Communities</b></p>

    @forelse($relatedCommunities as $item)
        <div class="rounded-4 shadow p-3 mt-2">
            <a class="d-flex flex-row m-0 p-0 text-decoration-none" href="{{ route("community.show", $item->slug) }}">
                @if($item->thumbnailImage)
                    <img class="rounded-2" src="{{ Illuminate\Support\Facades\Storage::url('/communities/thumbnails/' . $item->thumbnailImage->url ) }}" alt="{{ $item->thumbnailImage->alt }}">
                @else
                    <img class="rounded-2" src="{{ Illuminate\Support\Facades\Storage::url('/communities/thumbnails/default.png') }}" alt="communities">

                @endif
                <span class="d-flex flex-column justify-content-around ms-3">
                    <h6 class="h6 text-black mb-0">{{ $item->title }}</h6>
                    <p class="fs-1 text-dark-gray mb-0">{{ $item->users()->count() }} following</p>
                </span>
            </a>
        </div>
    @empty
    @endforelse
</div>
