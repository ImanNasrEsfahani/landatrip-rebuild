<div class="d-flex flex-row ps-5 mb-2">
    <a class="d-inline-block align-self-center h-100 text-decoration-none" href="{{ route("profile", $post->user->slug) }}">
        @if($post->user->profileImage)
            <img class="max-h-3rem rounded-circle" src="{{ asset('/user/profile/' . $post->user->profileImage?->url) }}" alt="{{ asset('/storage/user/profile/' . $post->user->profileImage?->alt) }}">
        @else
            <img class="max-h-3rem rounded-circle" src="{{ asset('/user/profile/') }}/{{ $post->user->sex === 2 ? "female.png" : "male.png" }}" alt="{{ $post->user->name }}">
        @endif
    </a>
    <div class="d-flex flex-column justify-content-center ms-2">
        <a class="align-self-center text-decoration-none pb-0 mb-1" href="{{ route("profile", $post->user->slug) }}">
            <h6 class="pt-3 px-2 pb-0 mb-0"><b>{{ $post->user->fname }} {{ $post->user->lname }}</b></h6>
        </a>
        <p class="fs-1 px-2 pb-0 text-dark">{{ \Carbon\Carbon::create($post->created_at)->diffForHumans() }}</p>
    </div>
</div>

<div class="d-flex flex-column ps-3 mt-2 mb-1">
    <span class="d-flex flex-row text-dark mb-1">
        <i class="align-self-center text-orange fa-solid fa-location-dot"></i>
        <span class="ms-2">{{ $post->location }}</span>
    </span>
    <p class="d-inline mb-1">{{ $post->title }}</p>
</div>
