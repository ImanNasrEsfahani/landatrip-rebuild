<div class="w-100 py-3 px-3 mt-3 mb-2 shadow bg-white rounded-3 text-start h-100">
    <p><b>Related Tours</b></p>
    @forelse($relatedTours as $item)
        <div class="rounded-4 shadow p-2 mt-3">
            <a class="row w-100 m-0 p-0 text-decoration-none" style="height: 5.5rem" href="{{ route("tour.show", $item->slug) }}">
                <span class="col-10 px-0 h-100 overflow-hidden rounded-4">
                    @if($item->thumbnailImage)
                        <img class="w-auto rounded-4 h-100" src="{{ asset('/courses/thumbnail/' . $item->thumbnailImage->url ) }}" alt="{{ $item->thumbnailImage->alt }}">
                    @else
                        <img class="w-auto rounded-4 h-100" src="{{ asset('/courses/thumbnail/default.png')}}" alt="">

                    @endif
                </span>
                <span class="col-14 d-flex flex-column justify-content-around ps-3 pe-0">
                    <h6 class="fs-3 mb-0 lh-base text-black my-2">{{ $item->title }}</h6>
                </span>
            </a>
        </div>
    @empty
    @endforelse
</div>

