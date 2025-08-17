<div class="d-flex flex-row justify-content-between px-3 mt-3 mb-2">
        <span class="d-flex flex-row">
            @if(auth()->check())
                @php
                    $userPostLikeObj = $post->userPostLikes()->where('user_id', '=', auth()->user()->id)->first();
                @endphp
                <div class="like-post-react-btn" user-slug="{{ auth()->user()->slug }}" post={{ $post->id }} text={{ __('pages/community.Like') }} count={{ $post->userPostLikes()->count() }} active={{ $userPostLikeObj ?  "like" : "dislike"}}></div>
            @else
                {{--                <div class="like-react-btn" active="LikeInactive" text={{ __('pages/community.Like') }} count={{ $post->userPostLikes()->count() }}></div>--}}
                <a class="btn btn-orange text-white align-self-center rounded-pill ms-2" href="{{ route('login') }}">Login</a>
            @endif
        </span>
    <span class="d-flex flex-row">
        <i class="text-orange align-self-center fa-solid fa-comment ms-3"></i>
        <p class="align-self-center text-dark-gray mb-0 ms-2 me-3">{{ $post->userPostComments()->count() }} {{ __('pages/profile.comments') }}</p>
        <i class="text-orange align-self-center fa-solid fa-share-nodes ms-3"></i>
        <p class="align-self-center text-dark-gray mb-0 ms-2 me-3">{{ __('pages/profile.2 Shares') }}</p>
    </span>
</div>
