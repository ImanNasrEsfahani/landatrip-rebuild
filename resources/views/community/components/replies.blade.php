@forelse($item->communityUserPostCommentReplies as $reply)
    <div class="d-flex flex-row mb-1 ms-5">
        <a class="d-inline text-decoration-none" href="{{ route("profile.show", $reply->user->slug) }}">
            @if($reply->user->profileImage)
                <img class="max-h-3rem ms-2 me-4 rounded-circle" src="{{ asset('/user/profile/' . $reply->user->profileImage?->url) }}" alt="{{ asset('/storage/user/profile/' . $reply->user->profileImage?->alt) }}">
            @else
                <img class="max-h-3rem ms-2 me-4 rounded-circle" src="{{ asset('/user/profile/') }}/{{ $reply->user->sex === 2 ? "female.png" : "male.png" }}" alt="{{ $reply->user->name }}">
            @endif
        </a>
        <div class="d-flex flex-column">
            <div class="bg-gray ps-1 pe-3 py-1 rounded-4 text-black">
                <a class="text-decoration-none" href="{{ route("profile.show", $reply->user->slug) }}">
                    <h6 class="pt-2 px-2 fs-2"><b>{{ $reply->user->fname }} {{ $reply->user->lname }}</b></h6>
                </a>
                <h6 class="px-2 text-dark fs-2">{{ $reply->reply }}</h6>
            </div>
            <div class="d-flex flex-row ms-4 mt-1 align-items-center">
                @if(auth()->check())
                    @php
                        $replyLikeObj = $reply->communityUserPostCommentReplyLikes()->where('user_id', '=', auth()->user()->id)->first();
                    @endphp
                    @if($replyLikeObj)


{{--                        <form action="{{ route('community.post.comment.reply.dislike', [$community, $post, $item, $reply, $replyLikeObj]) }}" method="POST">--}}
{{--                            @csrf--}}
{{--                            <button class="bg-transparent border-0">--}}
{{--                                <i class="fa-solid fa-thumbs-up text-orange align-self-center"></i>--}}
{{--                                <p class="d-inline text-decoration-none text-orange ms-2 mb-0 align-self-center fs-1">{{ __('pages/community.Like') }} ({{ $reply->communityUserPostCommentReplyLikes()->count() }})</p>--}}
{{--                            </button>--}}
{{--                        </form>--}}

                            <div class="like-react-btn" id={{auth()->user()->id}} text={{ __('pages/community.Like') }} count={{ $reply->communityUserPostCommentReplyLikes()->count() }} active="like"></div>

                    @else


{{--                        <form action="{{ route('community.post.comment.reply.like', [$community, $post, $item, $reply]) }}" method="POST">--}}
{{--                            @csrf--}}
{{--                            <button class="bg-transparent border-0">--}}
{{--                                <i class="fa-solid fa-thumbs-up text-dark-gray align-self-center"></i>--}}
{{--                                <p class="d-inline text-decoration-none text-dark-gray ms-2 mb-0 align-self-center fs-1">{{ __('pages/community.Like') }} ({{ $reply->communityUserPostCommentReplyLikes()->count() }})</p>--}}
{{--                            </button>--}}
{{--                        </form>--}}

                            <div class="like-react-btn" text={{ __('pages/community.Like') }} count={{ $reply->communityUserPostCommentReplyLikes()->count() }} active="dislike"></div>
                    @endif
                @else


{{--                    <form action="{{ route('community.post.comment.reply.like', [$community, $post, $item, $reply]) }}" method="POST">--}}
{{--                        @csrf--}}
{{--                        <button class="bg-transparent border-0">--}}
{{--                            <i class="fa-solid fa-thumbs-up text-dark-gray align-self-center"></i>--}}
{{--                            <p class="d-inline text-decoration-none text-dark-gray ms-2 mb-0 align-self-center fs-1">{{ __('pages/community.Like') }} ({{ $reply->communityUserPostCommentReplyLikes()->count() }})</p>--}}
{{--                        </button>--}}
{{--                    </form>--}}

                        <div class="like-react-btn" active="LikeInactive" text={{ __('pages/community.Like') }} count={{ $reply->communityUserPostCommentReplyLikes()->count() }}></div>

                @endif


                <a href="" class="btn bg-orange text-white px-3 fs-1 rounded-pill fw-bold mx-2">{{ __('pages/community.Reply') }}</a>
            </div>
        </div>
    </div>
@empty
@endforelse

