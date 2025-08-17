<div class="d-flex flex-row justify-content-between pb-2 px-3 mb-2">
    <div class="d-flex flex-row">
        @if(auth()->check())
            @php
                $communityUserPostLikeObj = $post->communityUserPostLikes()->where('user_id', '=', auth()->user()->id)->first()
            @endphp
            @if($communityUserPostLikeObj)


{{--                <form action="{{ route('community.post.dislike', [$community, $post, $communityUserPostLikeObj]) }}" method="POST">--}}
{{--                    @csrf--}}
{{--                    <button class="bg-transparent border-0">--}}
{{--                        <i class="text-align-center me-2 text-orange fa-solid fa-thumbs-up"></i>--}}
{{--                        <p class="d-inline mb-0 text-orange align-self-center">{{ __('pages/community.Like') }} ({{ $post->communityUserPostLikes()->count() }})</p>--}}
{{--                    </button>--}}
{{--                </form>--}}

                <div class="like-react-btn" id={{auth()->user()->id}} text={{ __('pages/community.Like') }} count={{ $post->communityUserPostLikes()->count() }} active="like"></div>
            @else

{{--                <form action="{{ route('community.post.like', [$community, $post]) }}" method="POST">--}}
{{--                    @csrf--}}
{{--                    <button class="bg-transparent border-0">--}}
{{--                        <i class="text-align-center me-2 text-dark-gray fa-solid fa-thumbs-up"></i>--}}
{{--                        <p class="d-inline text-dark mb-0 align-self-center">{{ __('pages/community.Like') }} ({{ $post->communityUserPostLikes()->count() }})</p>--}}
{{--                    </button>--}}
{{--                </form>--}}

                <div class="like-react-btn" text={{ __('pages/community.Like') }} count={{ $post->communityUserPostLikes()->count() }} active="dislike"></div>
            @endif
        @else

{{--            <form action="{{ route('community.post.like', [$community, $post]) }}" method="POST">--}}
{{--                @csrf--}}
{{--                <button class="bg-transparent border-0">--}}
{{--                    <i class="text-align-center me-2 text-dark-gray fa-solid fa-thumbs-up"></i>--}}
{{--                    <p class="d-inline text-dark mb-0 align-self-center">{{ __('pages/community.Like') }} ({{ $post->communityUserPostLikes()->count() }})</p>--}}
{{--                </button>--}}
{{--            </form>--}}

            <div class="like-react-btn" active="LikeInactive" text={{ __('pages/community.Like') }} count={{ $post->communityUserPostLikes()->count() }} ></div>
        @endif
    </div>
    <div class="d-flex flex-row">
        <i class="text-orange align-self-center fa-solid fa-comment"></i>
        <p class="ms-2 mb-0 text-dark me-3 align-self-center">{{ $post->communityUserPostComments()->count() }} {{ __('pages/community.comment') }}</p>
        <i class="text-orange align-self-center fa-solid fa-share-nodes"></i>
        <p class="ms-2 mb-0 text-dark align-self-center">{{ __('pages/community.2 shares') }}</p>
    </div>
</div>
<hr class="border border-dark w-100 my-0 py-0">



