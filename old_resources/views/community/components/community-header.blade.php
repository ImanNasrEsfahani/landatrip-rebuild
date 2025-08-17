<div class="bg-white shadow w-100 h-auto rounded-4 overflow-hidden mb-4">
    @if($community->headerImage)
        <img class="w-100" src="{{ asset('/communities/headers/' . $community->headerImage->url ) }}" alt="{{ $community->headerImage->alt }}">
    @else
        <img class="w-100" src="{{ asset('/communities/headers/default.png') }}" alt="">
    @endif

    <div class="d-flex flex-row justify-content-between py-3">
        <span class="ps-4 align-self-center">
            <p class="d-inline-block mb-0 fs-5"><b class="">{{ $community->title }}</b></p>
            <p class="d-inline-block mb-0 fs-1 ms-2">- Followers: {{ $community->users()->count() }}</p>
        </span>
        <span class="d-flex flex-row pe-2">
            @if(auth()->check())
                @if($community->users()->where('user_id', '=', auth()->user()->id)->first())
                    <form action="{{ route('community.unfollow', $community) }}" method="POST">
                        @csrf
                        <input type="hidden" value="@if (auth()->check()) auth()->user()->id @endif">
                        <input type="submit" value="Unfollow" class="btn btn-green shadow rounded-pill me-3 px-4 py-2 text-white border-0">
                    </form>
                @else
                    <form action="{{ route('community.follow', $community->slug) }}" method="POST">
                        @csrf
                        <input type="hidden" value="@if (auth()->check()) auth()->user()->id @endif">
                        <input type="submit" value="Follow" class="btn btn-orange shadow rounded-pill me-3 px-4 py-2 text-white border-0">
                    </form>
                @endif
            @else
                <form action="{{ route('community.follow', $community->slug) }}" method="POST">
                    @csrf
                    <input type="hidden" value="@if (auth()->check()) auth()->user()->id @endif">
                    <input type="submit" value="Follow" class="btn btn-orange shadow rounded-pill me-3 px-4 py-2 text-white border-0">
                </form>
            @endif
        </span>
    </div>
</div>
