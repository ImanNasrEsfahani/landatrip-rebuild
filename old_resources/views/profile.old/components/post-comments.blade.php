<div class="w-100 px-3">
    @forelse($post->userPostComments()->get() as $comment)
        <div class="row w-100 mt-2 mb-4">
            <div class="col-2 px-0 align-self-start">
            <a href="{{ route('profile.show', $comment->user) }}">
                <div class="mx-auto ratio ratio-1x1  mb-4">
                @if($comment->user->profileImage)
                    <img class="object-fit-cover ms-2 me-4 rounded-circle max-w-4rem max-h-4rem"
                         src="{{ asset('/users/profile/' . $comment->user->profileImage?->url) }}"
                         alt="{{ asset('/users/profile/' . $comment->user->profileImage?->alt) }}">
                @else
                    <img class="object-fit-cover ms-2 me-4 rounded-circle"
                         src="{{ asset('/users/profile/') }}/{{ $comment->user->sex === 2 ? "female.png" : "male.png" }}"
                         alt="{{ $comment->user->name }}">
                @endif
                </div>
            </a>
            </div>
            <div class="col-auto d-flex flex-column flex-grow-1 h-fit align-self-center">
                <div class="bg-gray w-100 rounded-4 text-black p-3">
                    <a class="text-decoration-none" href="{{ route('profile.show', $comment->user) }}">
                        <h6>{{ $comment->user->fname }} {{ $comment->user->lname }}</h6>
                    </a>
                    <p class="mb-0">{{ $comment->comment }}</p>
                </div>
                <div class="d-flex flex-row ms-4 mt-2">
                    @if(auth()->check())
                        @php
                            $commentLikeObj = $comment->userPostCommentLikes()->where('user_id', '=', auth()->user()->id)->first();
                        @endphp
                            <div class="like-comment-btn" user-id={{$user->slug}} post={{$post->id}} comment={{$comment->id}} text={{ __('pages/community.Like') }} count={{ $comment->userPostCommentLikes()->count() }} active={{$commentLikeObj ? "like" : "dislike" }}></div>
                    @else

                        <div class="like-comment-btn" active="LikeInactive" text={{ __('pages/community.Like') }} count={{ $comment->userPostCommentLikes()->count() }}></div>

                    @endif
                    @auth
                        <a href=""
                           class="btn btn-orange rounded-pill py-1 px-3 text-decoration-none text-white ms-2 fs-2 align-self-center">{{ __('pages/profile.Reply') }}</a>
                    @endauth
                </div>
            </div>
        </div>

        @includeIf('profile.components.post-comment-replies')
    @empty
    @endforelse

    @includeIf('profile.components.comment-form')
</div>
