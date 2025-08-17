<div class="reply pl-16 mt-3">
    <div class="flex justify-between items-center">
        <div class="flex items-center">
            <div class="text-start mr-2 lg:mr-3">
                <a class="text-decoration-none text-black stretched-link"
                        href="{{ route("profile", $reply->user->slug) }}">
                @if($reply->user->profileImage)
                    <img class="w-14 mx-4 rounded-full aspect-square"
                         src="{{ Storage::url('/users/profile/' . $reply->user->profileImage?->url) }}"
                         alt="{{ $reply->user->profileImage?->alt }}">
                @else
                    <img class="w-14 mx-4 rounded-full aspect-square"
                         src="{{ Storage::url('/users/profile/') }}/{{ $reply->user->sex === 2 ? "female.png" : "male.png" }}"
                         alt="{{ $reply->user->name }}">
                @endif
                </a>
            </div>
            <a class="text-decoration-none text-black " href="{{ route("profile", $reply->user->slug) }}"><p
                        class="text-lg font-bold mb-0">{{ $reply->user->fname }} {{ $reply->user->lname }}</p>
                <p class="text-info font-normal text-sm">{{ $reply->user->title }}</p>
            </a>
        </div>
        <p class="text-body2 mb-0 text-info">{{$reply->created_at->diffForHumans()}}</p>
    </div>
    <p class="text-justify fs-2 ml-5 mt-2 text-black">{!! $reply->reply !!}</p>
    <div class="flex flex-row ml-5 mt-2 justify-between">
            <span class="flex flex-row-reverse items-center text-info">
                 <div class="flex gap-x-2 likesReplyComments"
                      tourCommentReply="{{$reply->id}}"
                      count="{{ $reply->tourCommentReplyLikes()->count()}}"
                      @if(auth()->user())
                         isLiked={{ $reply->tourCommentReplyLikes()->where("user_id", "=", auth()->user()->id)->count() === 1 ? 1 : 0 }}
                     @else
                          onclick="loginHandler(event)" isLiked="-1"
                     @endif
                 >
                 </div>
            </span>
    </div>
</div>
