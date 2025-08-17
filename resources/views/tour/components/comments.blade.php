<div id="reviews" class="mt-32">
    <h4 class="align-center text-h4 mb-10 font-bold">{{ __('pages/tour-lang.Reviews') }}</h4>
    <div class="ml-0 md:ml-3">
        @forelse($tourComments as $item)
            <div class="comment flex flex-col md:flex-row justify-between md:items-center mt-3">
                <div class="flex items-center gap-x-5">
                    <div class="text-start relative">
                        <a class="text-decoration-none text-black stretched-link"
                           href="{{ route("profile", $item->user->slug) }}">
                            @if($item->user->profileImage)
                                <img class="w-[4rem] mr-4 rounded-full aspect-square"
                                     src="{{ Storage::url('/users/profile/' . $item->user->profileImage?->url) }}"
                                     alt="{{ $item->user->profileImage?->alt }}">
                            @else
                                <img class="w-[4rem] mr-4 rounded-full aspect-square"
                                     src="{{ Storage::url('/users/profile/') }}/{{ $item->user->sex === 2 ? "female.png" : "male.png" }}"
                                     alt="{{ $item->user->name }}">
                            @endif

                        </a>
                    </div>
                    <a class="text-decoration-none text-black " href="{{ route("profile", $item->user->slug) }}">
                        <p class="text-lg font-bold mb-0">{{ $item->user->fname }} {{ $item->user->lname }}</p>
                        <p class="text-info font-normal text-sm">{{ $item->user->title }}</p>
                    </a>
                </div>
                <div class="my-2">
                    <div class="rating rating-sm">
                        @for($star = 0; $star < 5; $star++)
                            @if($star < $item->star)
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.4493 1.86345L11.9182 4.80115C12.1161 5.20743 12.6474 5.59287 13.0953 5.67621L15.7518 6.11374C17.4498 6.39501 17.8457 7.62426 16.6268 8.85351L14.5538 10.9266C14.21 11.2703 14.0121 11.9475 14.1267 12.4371L14.7204 14.9998C15.1892 17.0207 14.1058 17.8125 12.3244 16.7499L9.83469 15.2706C9.38675 14.9998 8.6367 14.9998 8.18875 15.2706L5.69899 16.7499C3.91762 17.802 2.83421 17.0207 3.303 14.9998L3.89679 12.4371C3.99054 11.9371 3.79261 11.2599 3.44884 10.9161L1.37578 8.84309C0.156948 7.62426 0.552809 6.39501 2.25084 6.10332L4.90727 5.66579C5.35522 5.59287 5.88651 5.19701 6.08444 4.79073L7.55329 1.85303C8.35543 0.269589 9.64718 0.269589 10.4493 1.86345Z" fill="#FF8C00"/>
                                </svg>
                            @else
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.4493 1.86345L11.9182 4.80115C12.1161 5.20743 12.6474 5.59287 13.0953 5.67621L15.7518 6.11374C17.4498 6.39501 17.8457 7.62426 16.6268 8.85351L14.5538 10.9266C14.21 11.2703 14.0121 11.9475 14.1267 12.4371L14.7204 14.9998C15.1892 17.0207 14.1058 17.8125 12.3244 16.7499L9.83469 15.2706C9.38675 14.9998 8.6367 14.9998 8.18875 15.2706L5.69899 16.7499C3.91762 17.802 2.83421 17.0207 3.303 14.9998L3.89679 12.4371C3.99054 11.9371 3.79261 11.2599 3.44884 10.9161L1.37578 8.84309C0.156948 7.62426 0.552809 6.39501 2.25084 6.10332L4.90727 5.66579C5.35522 5.59287 5.88651 5.19701 6.08444 4.79073L7.55329 1.85303C8.35543 0.269589 9.64718 0.269589 10.4493 1.86345Z" fill="#E3E5E4"/>
                                </svg>
                            @endif
                        @endfor
                    </div>
                    <span>
                    <p class="text-body2 mb-0 text-info md:text-end">{{$item->created_at->diffForHumans()}}</p>
                    </span>
                </div>
            </div>
            <p class="text-justify fs-2 md:ml-3 lh-base text-black mt-2">{!! $item->comment !!}</p>
            <div>
                <div class="flex justify-between">
                    <div class="flex items-start my-3 md:ml-32 text-info text-body2 w-full">
                        <a class="flex gap-x-2 likeComments"
                                tourComment="{{ $item->id }}"
                                count="{{ $item->tourCommentLikes()->count()}}"
                                @if(auth()->user())
                                    isLiked={{ $item->tourCommentLikes()->where("user_id", "=", auth()->user()->id)->count() === 1 ? 1 : 0 }}
                                @else
                                onclick="loginHandler(event)" isLiked="-1"
                                @endif
                        >
                        </a>
                        <a class="replyComments w-full" tourComment="{{ $item->id }}" replyTo="{{ $item->user->fname }}"
                                @if(auth()->user())
                                    user="{{ auth()->user()->slug }}"
                                userProfile="{{ Storage::url("/users/profile/".auth()->user()->profileImage->url) }}"
                                @else
                                onclick="loginHandler(event)"
                               @endif
                        >
                        </a>
                    </div>
                </div>
            </div>
            @forelse($item->tourCommentReplies()->where('verify_at','!=',null)->get() as $reply)
                @includeIf('tour.components.reply-comment')
            @empty
            @endforelse
            <hr class="text-gray my-2">
        @empty
            <p class="text-danger h2">{{ __('pages/tour-lang.No comment') }}</p>
        @endforelse
    </div>
</div>
