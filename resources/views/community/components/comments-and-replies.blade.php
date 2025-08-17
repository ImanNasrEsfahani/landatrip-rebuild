<div class="d-flex flex-column my-3">
    @forelse($post->communityUserPostComments as $item)
        <div class="d-flex flex-row mt-2 mb-1">
            <a class="d-inline text-decoration-none" href="{{ route("profile.show", $item->user->slug) }}">
                @if($item->user->profileImage)
                    <img class="max-h-4rem ms-2 me-4 rounded-circle" src="{{ asset('/user/profile/' . $item->user->profileImage?->url) }}" alt="{{ asset('/storage/user/profile/' . $item->user->profileImage?->alt) }}">
                @else
                    <img class="max-h-4rem ms-2 me-4 rounded-circle" src="{{ asset('/user/profile/') }}/{{ $item->user->sex === 2 ? "female.png" : "male.png" }}" alt="{{ $item->user->name }}">
                @endif
            </a>
            <div class="d-flex flex-column">
                <div class="bg-gray ps-2 pe-4 py-1 rounded-4 text-black">
                    <a class="text-decoration-none" href="{{ route("profile.show", $item->user->slug) }}">
                        <h6 class="pt-2 px-2"><b>{{ $item->user->fname }} {{ $item->user->lname }}</b></h6>
                    </a>
                    <h6 class="px-2 text-dark">{{ $item->comment }}</h6>
                </div>
                <div class="d-flex flex-row ms-4 mt-2">
                    @if(auth()->check())
                        @php
                            $commentLikeObj = $item->communityUserPostCommentLikes()->where('user_id', '=', auth()->user()->id)->first();
                        @endphp
                        @if($commentLikeObj)

{{--                            <form action="{{ route('community.post.comment.dislike', [$community, $post, $item, $commentLikeObj]) }}" method="POST">--}}
{{--                                @csrf--}}
{{--                                <button class="bg-transparent border-0">--}}
{{--                                    <i class="fa-solid fa-thumbs-up text-orange align-self-center"></i>--}}
{{--                                    <p class="d-inline text-decoration-none text-orange ms-2 mb-0 align-self-center">{{ __('pages/community.Like') }} ({{ $item->communityUserPostCommentLikes()->count() }})</p>--}}
{{--                                </button>--}}
{{--                            </form>--}}

                                <div class="like-react-btn" id={{auth()->user()->id}} text={{ __('pages/community.Like') }} count={{ $item->communityUserPostCommentLikes()->count() }} active="like"></div>

                        @else

{{--                            <form action="{{ route('community.post.comment.like', [$community, $post, $item]) }}" method="POST">--}}
{{--                                @csrf--}}
{{--                                <button class="bg-transparent border-0">--}}
{{--                                    <i class="fa-solid fa-thumbs-up text-dark-gray align-self-center"></i>--}}
{{--                                    <p class="d-inline text-decoration-none text-dark-gray ms-2 mb-0 align-self-center">{{ __('pages/community.Like') }} ({{ $item->communityUserPostCommentLikes()->count() }})</p>--}}
{{--                                </button>--}}
{{--                            </form>--}}

                                <div class="like-react-btn" text={{ __('pages/community.Like') }} count={{ $item->communityUserPostCommentLikes()->count() }} active="dislike"></div>

                        @endif
                    @else

{{--                        <form action="{{ route('community.post.comment.like', [$community, $post, $item]) }}" method="POST">--}}
{{--                            @csrf--}}
{{--                            <button class="bg-transparent border-0">--}}
{{--                                <i class="fa-solid fa-thumbs-up text-dark-gray align-self-center"></i>--}}
{{--                                <p class="d-inline text-decoration-none text-dark-gray ms-2 mb-0 align-self-center">{{ __('pages/community.Like') }} ({{ $item->communityUserPostCommentLikes()->count() }})</p>--}}
{{--                            </button>--}}
{{--                        </form>--}}

                             <div class="like-react-btn" active="LikeInactive" text={{ __('pages/community.Like') }} count={{ $item->communityUserPostCommentLikes()->count() }}></div>
                    @endif
                    <a href="" class="btn bg-orange text-white px-3 fs-1 rounded-pill fw-bold mx-2">{{ __('pages/community.Reply') }}</a>
                </div>
            </div>
        </div>

        @includeIf('community.components.replies')
    @empty
    @endforelse
</div>
