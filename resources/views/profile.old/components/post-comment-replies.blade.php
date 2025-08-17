@forelse($comment->userPostCommentReplies()->get() as $reply)
    <div class="row ms-5 mt-2 mb-4">
        <div class="col-2 px-0 align-self-start">
        <a href="{{ route('profile.show', $reply->user) }}">
            <div class="mx-auto ratio ratio-1x1 max-w-2rem mb-4">
            @if($reply->user->profileImage)
                <img class="object-fit-cover ms-2 me-4 rounded-circle"
                     src="{{ asset('/users/profile/' . $reply->user->profileImage?->url) }}"
                     alt="{{ asset('/users/profile/' . $reply->user->profileImage?->alt) }}">
            @else
                <img class="object-fit-cover ms-2 me-4 rounded-circle"
                     src="{{ asset('/users/profile/') }}/{{ $reply->user->sex === 2 ? "female.png" : "male.png" }}"
                     alt="{{ $reply->user->name }}">
            @endif
            </div>
        </a>
        </div>
        <div class="col-auto d-flex flex-column flex-grow-1 h-fit align-self-center">
            <div class="bg-gray w-100 rounded-4 text-black p-3">
                <a class="text-decoration-none" href="{{ route('profile.show', $reply->user) }}">
                    <h6 class="fs-2">{{ $reply->user->fname }} {{ $reply->user->lname }}</h6>
                </a>
                <p class="mb-0 fs-1">{{ $reply->reply }}</p>
            </div>
            <div class="d-flex flex-row ms-4 mt-2">
                @if(auth()->check())
                    @php
                        $ReplyLikeObj = $reply->userPostCommentReplyLikes()->where('user_id', '=', auth()->user()->id)->first();
                    @endphp
                    @if($ReplyLikeObj)

{{--                        --}}
{{--                        <form--}}
{{--                            action="{{ route('profile.post.comment.reply.dislike', [$user, $post, $comment, $reply, $ReplyLikeObj]) }}"--}}
{{--                            method="POST">--}}
{{--                            @csrf--}}
{{--                            <button class="bg-transparent border-0">--}}
{{--                                <i class="fa-solid fa-thumbs-up text-orange align-self-center fs-1"></i>--}}
{{--                                <p class="d-inline text-decoration-none text-orange ms-2 mb-0 fs-1 align-self-center">{{ __('pages/profile.like') }}--}}
{{--                                    ({{ $reply->userPostCommentReplyLikes()->count() }})</p>--}}
{{--                            </button>--}}
{{--                        </form>--}}
                        <div class="like-react-btn" id={{auth()->user()->id}} text={{ __('pages/community.Like') }} count={{ $reply->userPostCommentReplyLikes()->count() }} active="like"></div>


                    @else


{{--                        <form action="{{ route('profile.post.comment.reply.like', [$user, $post, $comment, $reply]) }}"--}}
{{--                              method="POST">--}}
{{--                            @csrf--}}
{{--                            <button class="bg-transparent border-0">--}}
{{--                                <i class="fa-solid fa-thumbs-up text-dark-gray align-self-center fs-1"></i>--}}
{{--                                <p class="d-inline text-decoration-none text-dark-gray ms-2 mb-0 fs-1 align-self-center">{{ __('pages/profile.like') }}--}}
{{--                                    ({{ $reply->userPostCommentReplyLikes()->count() }})</p>--}}
{{--                            </button>--}}
{{--                        </form>--}}
                        <div class="like-react-btn" text={{ __('pages/community.Like') }} count={{ $reply->userPostCommentReplyLikes()->count() }} active="dislike"></div>

                    @endif
                @else


{{--                    <form--}}
{{--                        action="{{ route('profile.post.comment.reply.like', [$user->slug, $post, $comment, $reply]) }}"--}}
{{--                        method="POST">--}}
{{--                        @csrf--}}
{{--                        <button class="bg-transparent border-0">--}}
{{--                            <i class="fa-solid fa-thumbs-up text-dark-gray align-self-center fs-1"></i>--}}
{{--                            <p class="d-inline text-decoration-none text-dark-gray ms-2 mb-0 fs-1 align-self-center">{{ __('pages/profile.like') }}--}}
{{--                                ({{ $reply->userPostCommentReplyLikes()->count() }})</p>--}}
{{--                        </button>--}}
{{--                    </form>--}}
                    <div class="like-react-btn" active="LikeInactive" text={{ __('pages/community.Like') }} count={{ $reply->userPostCommentReplyLikes()->count() }}></div>


                @endif
                @auth
                    <a href=""
                       class="btn btn-orange rounded-pill py-1 px-3 text-decoration-none text-white ms-2 fs-2 align-self-center">{{ __('pages/profile.Reply') }}</a>
                @endauth
            </div>
        </div>
    </div>
@empty
@endforelse
