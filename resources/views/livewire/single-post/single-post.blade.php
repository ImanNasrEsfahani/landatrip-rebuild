<div id="{{ $post->id }}" class="shadow-xl pt-8 rounded-2xl mb-10"
    x-data="{showComments:false, showReplyBox:false, comment:'', commenter:'', profileUrl:'', commentId:''}">
    @php($isLiked = auth()->user() ? $post->userPostLikes()->where("user_id", "=", auth()->user()->id)->count():0)
    @php($isSaved = auth()->user() ? $post->usersPostSaved()->where("user_id", "=", auth()->user()->id)->count():0)
    <div class="flex mx-8 mb-6">
        <div>
            <img
                class="w-12 h-12 rounded-full border aspect-square object-cover @if($user->hasRole(['user'])) border-secondary @else border-primary @endif "
                src="{{ Storage::url('/users/profile/'.$user->profileImage->url) }}"
                alt="{{ $user->fname." ".$user->lname }}">
        </div>
        <div class="ml-5">
            <P class="text-2xl font-bold leading-8">{{ $user->fname." ".$user->lname }}</P>
            <p class="text-base font-bold leading-5 text-[#646665]">{{ $post->location }} - {{ $post->created_at->diffForHumans() }}</p>
        </div>
        <div class="ml-auto">
            <svg width="27" height="7" viewBox="0 0 27 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="3.5" cy="3.5" r="3" fill="#323333"/>
                <circle cx="13.5" cy="3.5" r="3" fill="#323333"/>
                <circle cx="23.5" cy="3.5" r="3" fill="#323333"/>
            </svg>

        </div>
    </div>
    <div class="relative">
        @if($post->images->count()<=1)
            @if(str_contains($post->images[0]->file_type, 'video'))
                <video class="w-full h-[30rem] rounded-lg" loop controls>
                    <source src="{{ Storage::url('posts/'.$post->images[0]->url) }}" type="video/mp4">
                </video>
            @else
                <img class="w-full aspect-video object-cover" src="{{ Storage::url('posts/'.$post->images[0]->url) }}"
                    alt="svg">
            @endif
        @else
            <div x-data="carousel{{$post->id}}" class="relative">
                <template x-if="type[selected] == 'image/png' || type[selected] == 'image/jpg' || type[selected] == 'image/jpeg'">
                    <img class="w-full aspect-video object-cover" :src="'{{ Storage::url('posts/') }}' + images[selected]" alt="{{$post->title}}" />
                </template>
                <template x-if="type[selected] == 'video/mp4'">
                    <video class="w-full aspect-video object-cover"  controls loop>
                        <source :src="'{{ Storage::url('posts/') }}'+ images[selected]" type="video/mp4">
                    </video>
                </template>
                <button
                    @click="if (selected > 0 ) {selected -= 1} else { selected = images.length - 1 }"
                    class="absolute inset-y-0 left-0 px-2 py-[25%] h-full w-8 group hover:bg-gray-500 hover:bg-opacity-75 cursor-pointer"
                >
        <span class="text-gray-50">
          <svg class="fill-none" width="21" height="39" viewBox="0 0 21 39" xmlns="http://www.w3.org/2000/svg">
            <path d="M18.5 2.09473L2.88252 18.4559C2.11923 19.2555 2.14942 20.5227 2.94992 21.2851L18.5 36.0947" stroke="white" stroke-width="4" stroke-linecap="round"/>
            </svg>
        </span>
                </button>
                <button
                    @click="if (selected < images.length - 1  ) {selected += 1} else { selected = 0 }"
                    class="absolute inset-y-0 right-0 px-2 py-[25%] h-full w-8 group hover:bg-gray-500 hover:bg-opacity-75 cursor-pointer"
                >
        <span class="text-gray-50">
          <svg class="fill-none" width="21" height="39" viewBox="0 0 21 39" xmlns="http://www.w3.org/2000/svg">
            <path d="M2 2.09473L17.6175 18.4559C18.3808 19.2555 18.3506 20.5227 17.5501 21.2851L2 36.0947" stroke="white" stroke-width="4" stroke-linecap="round"/>
        </svg>
        </span>
                </button>
                <div class="absolute bottom-0 w-full p-4 flex justify-center space-x-2">
                    <template x-for="(image,index) in images" :key="index">
                        <button
                            @click="selected = index"
                            :class="{'bg-secondary': selected == index, 'bg-white': selected != index}"
                            class="h-2 w-2 rounded-full hover:bg-primary border-none"
                        ></button>
                    </template>
                </div>
            </div>
        @endif
{{--        @dd($post->group->thumbnailImage->url)--}}
        @if($post->group)
            <div
                class="flex items-center p-2 rounded-xl  absolute left-3 bottom-3 bg-white bg-opacity-50 backdrop-opacity-95 backdrop-blur">
                <img class="w-16 h-16 rounded-full aspect-square object-cover" src="{{ Storage::url('/groups/thumbnails/'.$post->group->thumbnailImage->url) }}"
                    alt="img">
                <div class="flex flex-col justify-center items-center ml-4">
                    <p class="font-EB Garamond ">{{ $post->group->title }}</p>
                    <div class="flex">
                        <img src="{{ Storage::url('website/profile/location.svg') }}" alt="svg">
                        <p>{{ $post->group->tour->city->country->name }}, {{ $post->group->tour->city->name }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="px-6 py-4 flex ">
        <div class="flex items-center">
            <button wire:click="like">
                <div class="p-1 @if($isLiked) bg-pink @else bg-lightGray @endif rounded-lg">
                    <svg class="@if($isLiked) fill-white @else fill-accent @endif" width="25" height="24"
                        viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.89062 18.4897V8.32973C8.89062 7.92973 9.01062 7.53973 9.23062 7.20973L11.9606 3.14973C12.3906 2.49973 13.4606 2.03973 14.3706 2.37973C15.3506 2.70973 16.0006 3.80973 15.7906 4.78973L15.2706 8.05973C15.2306 8.35973 15.3106 8.62973 15.4806 8.83973C15.6506 9.02973 15.9006 9.14973 16.1706 9.14973H20.2806C21.0706 9.14973 21.7506 9.46973 22.1506 10.0297C22.5306 10.5697 22.6006 11.2697 22.3506 11.9797L19.8906 19.4697C19.5806 20.7097 18.2306 21.7197 16.8906 21.7197H12.9906C12.3206 21.7197 11.3806 21.4897 10.9506 21.0597L9.67062 20.0697C9.18062 19.6997 8.89062 19.1097 8.89062 18.4897Z"/>
                        <path
                            d="M5.71 6.37988H4.68C3.13 6.37988 2.5 6.97988 2.5 8.45988V18.5199C2.5 19.9999 3.13 20.5999 4.68 20.5999H5.71C7.26 20.5999 7.89 19.9999 7.89 18.5199V8.45988C7.89 6.97988 7.26 6.37988 5.71 6.37988Z"/>
                    </svg>
                </div>
            </button>
            <p class="ml-1 font-light text-lg leading-6 text-info">{{ $post->userPostLikes->count() }} Like</p>
        </div>
        <div class="flex items-center ml-auto">
            <button @click="showComments= !showComments;">
                <div class="p-1 rounded-lg" :class="showComments ? 'bg-pink' : 'bg-lightGray' ">
                    <svg :class="showComments ? 'fill-white' : 'fill-accent' " width="23" height="23"
                        viewBox="0 0 21 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M15.5 0H5.5C2.74 0 0.5 2.23 0.5 4.98V10.96V11.96C0.5 14.71 2.74 16.94 5.5 16.94H7C7.27 16.94 7.63 17.12 7.8 17.34L9.3 19.33C9.96 20.21 11.04 20.21 11.7 19.33L13.2 17.34C13.39 17.09 13.69 16.94 14 16.94H15.5C18.26 16.94 20.5 14.71 20.5 11.96V4.98C20.5 2.23 18.26 0 15.5 0ZM6.5 10C5.94 10 5.5 9.55 5.5 9C5.5 8.45 5.95 8 6.5 8C7.05 8 7.5 8.45 7.5 9C7.5 9.55 7.06 10 6.5 10ZM10.5 10C9.94 10 9.5 9.55 9.5 9C9.5 8.45 9.95 8 10.5 8C11.05 8 11.5 8.45 11.5 9C11.5 9.55 11.06 10 10.5 10ZM14.5 10C13.94 10 13.5 9.55 13.5 9C13.5 8.45 13.95 8 14.5 8C15.05 8 15.5 8.45 15.5 9C15.5 9.55 15.06 10 14.5 10Z"/>
                    </svg>
                </div>
            </button>
            <p class="ml-1 font-light text-lg leading-6 text-info">{{ $post->userPostComments->count() }} Comment</p>
        </div>
        <div class="flex items-center ml-12">
            <div class="p-1 bg-lightGray rounded-lg">
                <svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M13.6411 0.960043L4.61109 3.96004C-1.45891 5.99004 -1.45891 9.30004 4.61109 11.32L7.29109 12.21L8.18109 14.89C10.2011 20.96 13.5211 20.96 15.5411 14.89L18.5511 5.87004C19.8911 1.82004 17.6911 -0.389957 13.6411 0.960043ZM13.9611 6.34004L10.1611 10.16C10.0111 10.31 9.82109 10.38 9.63109 10.38C9.44109 10.38 9.25109 10.31 9.10109 10.16C8.81109 9.87004 8.81109 9.39004 9.10109 9.10004L12.9011 5.28004C13.1911 4.99004 13.6711 4.99004 13.9611 5.28004C14.2511 5.57004 14.2511 6.05004 13.9611 6.34004Z"
                        fill="#646665"/>
                </svg>
            </div>
        </div>
        <div class="flex items-center ml-3">
            <button wire:click="savePost">
                <div class="p-1 @if($isSaved) bg-pink @else bg-lightGray @endif rounded-lg">
                    <svg class="@if($isSaved) fill-white @else fill-accent @endif" width="19" height="21"
                        viewBox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12.5989 0.571289C15.5799 0.571289 17.9889 1.62075 18.0219 4.28853V19.1771C18.0219 19.3439 17.9779 19.5106 17.8899 19.6577C17.7469 19.8931 17.5049 20.0697 17.2079 20.1481C16.9219 20.2266 16.6029 20.1873 16.3389 20.05L9.21088 16.8722L2.07188 20.05C1.90798 20.1275 1.71987 20.1775 1.53288 20.1775C0.916875 20.1775 0.421875 19.7264 0.421875 19.1771V4.28853C0.421875 1.62075 2.84188 0.571289 5.81188 0.571289H12.5989ZM13.3469 6.49534H5.06388C4.59088 6.49534 4.20587 6.83862 4.20587 7.27017C4.20587 7.70075 4.59088 8.04501 5.06388 8.04501H13.3469C13.8199 8.04501 14.2049 7.70075 14.2049 7.27017C14.2049 6.83862 13.8199 6.49534 13.3469 6.49534Z"/>
                    </svg>
                </div>
            </button>
        </div>
    </div>
    <div class="content">
        <div x-data="{ open: false, maxLength: 100, fullText: '', slicedText: '' }"
            x-init="fullText = $el.firstElementChild.textContent.trim(); slicedText = fullText.slice(0, maxLength)">
            <div :class="open ? 'block' : 'flex' ">
                <p class="px-5 text-xl font-bold leading-6 text-black" x-text="open ? fullText : slicedText"
                    x-transition>{{ $post->title }}</p>
                <div :class="open ? 'text-end pe-10' : '' ">
                    <button x-show="fullText.length>maxLength" class="text-lg font-bold text-gray"
                        @click="open = ! open" x-text="open ? 'Show less' : 'more...'"></button>
                </div>
            </div>
        </div>
    </div>
    {{--<p class="text-[#007560] text-end mt-1 px-6 font-bold leading-5">See translation</p>--}}
    <div class="py-6 px-4 border-t mt-2" x-show="showComments" x-transition.duration.300ms>
        <div class="overflow-y-scroll scrollbarInputs max-h-[37rem]">
            @forelse($post->userPostComments as $comment)
                @php($isLikedComment = auth()->user() ? $comment->userPostCommentLikes()->where("user_id","=",auth()->user()->id)->count():0)
                <div class="flex items-start mb-5">
                    <a wire:navigate.hover href="{{route("profile", $comment->user->slug)}}">
                    <img
                        class="w-12 h-12 aspect-square object-cover rounded-full border-2 @if($comment->user->hasRole(['user'])) border-secondary @else border-primary @endif"
                        src="{{ Storage::url('/users/profile/'.$comment->user->profileImage->url) }}" alt="">
                    </a>
                    <div class="ml-4">
                        <div
                            class="py-2 px-4 rounded-xl bg-lightGray inline-block  border-l-4 @if($comment->user->hasRole(['user'])) border-secondary @else border-primary @endif">
                            <p class="font-bold leading-5">{{ $comment->user->fname." ".$comment->user->lname }}</p>
                            <p class="mt-2 font-bold text-[14px] leading-6">{{$comment->comment}}</p>
                        </div>
                        <div class="mt-2 divide-x-2 divide-gray flex">
                            <div class="flex items-center">
                                <button wire:click="likeComment('{{ $comment->id }}')">
                                    <div
                                        class="p-1 @if($isLikedComment) bg-pink @else bg-lightGray @endif rounded-full">
                                        <svg class="@if($isLikedComment) fill-white @else fill-accent @endif" width="17"
                                            height="16" viewBox="0 0 25 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.89062 18.4897V8.32973C8.89062 7.92973 9.01062 7.53973 9.23062 7.20973L11.9606 3.14973C12.3906 2.49973 13.4606 2.03973 14.3706 2.37973C15.3506 2.70973 16.0006 3.80973 15.7906 4.78973L15.2706 8.05973C15.2306 8.35973 15.3106 8.62973 15.4806 8.83973C15.6506 9.02973 15.9006 9.14973 16.1706 9.14973H20.2806C21.0706 9.14973 21.7506 9.46973 22.1506 10.0297C22.5306 10.5697 22.6006 11.2697 22.3506 11.9797L19.8906 19.4697C19.5806 20.7097 18.2306 21.7197 16.8906 21.7197H12.9906C12.3206 21.7197 11.3806 21.4897 10.9506 21.0597L9.67062 20.0697C9.18062 19.6997 8.89062 19.1097 8.89062 18.4897Z"/>
                                            <path
                                                d="M5.71 6.37988H4.68C3.13 6.37988 2.5 6.97988 2.5 8.45988V18.5199C2.5 19.9999 3.13 20.5999 4.68 20.5999H5.71C7.26 20.5999 7.89 19.9999 7.89 18.5199V8.45988C7.89 6.97988 7.26 6.37988 5.71 6.37988Z"/>
                                        </svg>
                                    </div>
                                </button>
                                <p class="ml-1 font-medium text-lg leading-6 text-info me-2">{{ $comment->userPostCommentLikes->count() }}</p>
                            </div>
                            <div class="flex items-center pl-2">
                                <svg class="stroke-accent stroke-2" width="20" height="20" viewBox="0 0 30 30"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.91406 22.8877H18.9141C22.3641 22.8877 25.1641 20.0877 25.1641 16.6377C25.1641 13.1877 22.3641 10.3877 18.9141 10.3877H5.16406"/>
                                    <path d="M8.03594 13.5123L4.83594 10.3123L8.03594 7.1123"/>
                                </svg>
                                <p class="ml-1 font-bold text-[14px] leading-6 text-info">{{ $comment->userPostCommentReplies->count() }}</p>
                                <button
                                    @click='comment = "{{$comment->comment}}"; commenter="{{ $comment->user->fname." ".$comment->user->lname }}"; profileUrl="{{ Storage::url('/users/profile/'.$comment->user->profileImage->url) }}"; showReplyBox = true; commentId="{{$comment->id}}"'
                                    class="ml-2 font-bold text-[14px] leading-6 text-info">Reply
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- -----------------replay----------------- --}}
                <div class="ml-16 pl-3 border-l-[3px] border-gray">
                    @forelse($comment->userPostCommentReplies as $reply)
                        @php($isLikedCommentReply = auth()->user() ? $reply->userPostCommentReplyLikes()->where("user_id","=",auth()->user()->id)->count():0)
                        <div class="  my-5">
                            <div class="flex items-start mt-5 ">
                                <a wire:navigate.hover href="{{route("profile", $reply->user->slug)}}">
                                <img
                                    class="w-12 h-12 rounded-full border-2 @if($reply->user->hasRole(['user'])) border-secondary @else border-primary @endif"
                                    src="{{ Storage::url('/users/profile/'.$reply->user->profileImage->url) }}" alt="">
                                </a>
                                <div class="ml-4">
                                    <div
                                        class="py-2 px-4 rounded-xl bg-lightGray inline-block  border-l-4 @if($reply->user->hasRole(['user'])) border-secondary @else border-primary @endif">
                                        <p class="font-bold leading-5">{{ $reply->user->fname." ".$reply->user->lname }}</p>
                                        <p class="mt-2 font-bold text-[14px] leading-6">{{ $reply->reply }}</p>
                                    </div>
                                    <div class="mt-2">
                                        <div class="flex items-center pr-2">
                                            <button wire:click="likeCommentReply('{{ $reply->id }}')">
                                                <div
                                                    class="p-1 @if($isLikedCommentReply) bg-pink @else bg-lightGray @endif rounded-full">
                                                    <svg
                                                        class="@if($isLikedCommentReply) fill-white @else fill-accent @endif"
                                                        width="15" height="14" viewBox="0 0 25 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M8.89062 18.4897V8.32973C8.89062 7.92973 9.01062 7.53973 9.23062 7.20973L11.9606 3.14973C12.3906 2.49973 13.4606 2.03973 14.3706 2.37973C15.3506 2.70973 16.0006 3.80973 15.7906 4.78973L15.2706 8.05973C15.2306 8.35973 15.3106 8.62973 15.4806 8.83973C15.6506 9.02973 15.9006 9.14973 16.1706 9.14973H20.2806C21.0706 9.14973 21.7506 9.46973 22.1506 10.0297C22.5306 10.5697 22.6006 11.2697 22.3506 11.9797L19.8906 19.4697C19.5806 20.7097 18.2306 21.7197 16.8906 21.7197H12.9906C12.3206 21.7197 11.3806 21.4897 10.9506 21.0597L9.67062 20.0697C9.18062 19.6997 8.89062 19.1097 8.89062 18.4897Z"/>
                                                        <path
                                                            d="M5.71 6.37988H4.68C3.13 6.37988 2.5 6.97988 2.5 8.45988V18.5199C2.5 19.9999 3.13 20.5999 4.68 20.5999H5.71C7.26 20.5999 7.89 19.9999 7.89 18.5199V8.45988C7.89 6.97988 7.26 6.37988 5.71 6.37988Z"/>
                                                    </svg>
                                                </div>
                                            </button>
                                            <p class="ml-1 font-medium text-lg leading-6 text-info">{{ $reply->userPostCommentReplyLikes->count() }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- -----------------end of replay----------------- --}}
                    @empty
                    @endforelse
                </div>
            @empty
            @endforelse
        </div>
    </div>
    <div class="shadow-2xl px-7 py-5 mt-6 rounded-2xl" @close_reply.window="showReplyBox= false; comment=''; commenter=''; profileUrl=''; commentId=''; showComments=true ">
        <div class="p-4 border-lightGray border-b-2 flex w-full" x-show="showReplyBox">
            <div class="grow-0">
                <img class="aspect-square w-[3rem] rounded-full" :src="profileUrl" alt="">
            </div>
            <div class="grow ms-3">
                <div class="w-full flex items-center">
                    <svg class="stroke-primary stroke-2" width="20" height="20" viewBox="0 0 30 30" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.91406 22.8877H18.9141C22.3641 22.8877 25.1641 20.0877 25.1641 16.6377C25.1641 13.1877 22.3641 10.3877 18.9141 10.3877H5.16406"/>
                        <path d="M8.03594 13.5123L4.83594 10.3123L8.03594 7.1123"/>
                    </svg>
                    <span class="font-medium text-primary text-lg mx-2">Reply to</span>
                    <span class="font-medium text-lg" x-text="commenter"></span>
                </div>
                <p x-text="comment"></p>
            </div>
            <button class="self-start" @click=" showReplyBox=false; comment=''; commenter=''; profileUrl=''; commentId='' ">
                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.5 23.48C6.57 23.48 1.75 18.66 1.75 12.73C1.75 6.79998 6.57 1.97998 12.5 1.97998C18.43 1.97998 23.25 6.79998 23.25 12.73C23.25 18.66 18.43 23.48 12.5 23.48ZM12.5 3.47998C7.4 3.47998 3.25 7.62998 3.25 12.73C3.25 17.83 7.4 21.98 12.5 21.98C17.6 21.98 21.75 17.83 21.75 12.73C21.75 7.62998 17.6 3.47998 12.5 3.47998Z" fill="#323333"/>
                    <path d="M9.66937 16.3098C9.47937 16.3098 9.28938 16.2398 9.13938 16.0898C8.84938 15.7998 8.84938 15.3198 9.13938 15.0298L14.7994 9.36984C15.0894 9.07984 15.5694 9.07984 15.8594 9.36984C16.1494 9.65984 16.1494 10.1398 15.8594 10.4298L10.1994 16.0898C10.0594 16.2398 9.85937 16.3098 9.66937 16.3098Z" fill="#323333"/>
                    <path d="M15.3294 16.3098C15.1394 16.3098 14.9494 16.2398 14.7994 16.0898L9.13938 10.4298C8.84938 10.1398 8.84938 9.65984 9.13938 9.36984C9.42937 9.07984 9.90937 9.07984 10.1994 9.36984L15.8594 15.0298C16.1494 15.3198 16.1494 15.7998 15.8594 16.0898C15.7094 16.2398 15.5194 16.3098 15.3294 16.3098Z" fill="#323333"/>
                </svg>
            </button>
        </div>
        <div class="flex items-center mt-2">
            @if(auth()->user() && auth()->user()->profileImage)
                <a wire:navigate.hover href="{{route('profile', auth()->user()->slug)}}">
                <img
                    class="w-12 h-12 rounded-full border-2 @if(auth()->user()->hasRole(['user'])) border-secondary @else border-primary @endif"
                    src="{{ Storage::url('/users/profile/'.auth()->user()->profileImage->url) }}"
                    alt="{{ auth()->user()->fname." ".auth()->user()->lname }}">
                </a>
            @else
                <img class="w-12 h-12 rounded-full border-2 border-info"
                    src="{{ Storage::url('/users/profile/'.(auth()->user() ?(auth()->user()->sex->value ? "male.webp":"female.webp"):"male.webp")) }}"
                    alt="Landa Trip">
            @endif
            <div class="grow">
                <form class="ml-3 rounded-3xl w-full bg-lightGray px-5 flex">
                    <input wire:model="comment"
                        class="input rounded-3xl bg-lightGray w-full focus:outline-0 text-lg text-black font-normal"
                        placeholder="what do you want to talk about?" type="text"/>
                    <button type="submit" x-on:click.prevent="$wire.saveComment(commentId)">
                        <svg class="fill-primary" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2.12635 0.730469C1.57587 0.730469 1.04795 0.941182 0.658701 1.31626C0.269456 1.69133 0.0507813 2.20004 0.0507812 2.73047V8.73047C0.0514566 9.1447 0.185594 9.54851 0.434668 9.88612C0.683741 10.2237 1.03546 10.4785 1.44125 10.6152C1.66126 10.6905 1.89288 10.7295 2.12635 10.7305C2.13378 10.7305 2.14121 10.7305 2.14864 10.7305L14.5798 12.7305L2.14864 14.7324C2.14122 14.7317 2.13378 14.7311 2.12635 14.7305C1.8922 14.7313 1.65988 14.7702 1.43922 14.8457C1.03381 14.9828 0.682531 15.2377 0.433841 15.5753C0.185151 15.9128 0.0513092 16.3165 0.0507812 16.7305V22.7305C0.0507813 23.2609 0.269456 23.7696 0.658701 24.1447C1.04795 24.5198 1.57587 24.7305 2.12635 24.7305C2.48772 24.7298 2.84265 24.6382 3.15602 24.4648H3.15805L24.3252 13.6523L24.3272 13.6484C24.514 13.5716 24.6732 13.4437 24.7853 13.2805C24.8973 13.1174 24.9572 12.9261 24.9576 12.7305C24.9579 12.5339 24.898 12.3417 24.7855 12.1777C24.6731 12.0138 24.513 11.8854 24.3252 11.8086L3.15805 0.996094C2.84408 0.82236 2.48841 0.730787 2.12635 0.730469Z"/>
                        </svg>
                    </button>
                </form>
                <div>
                    @error('comment') <span class="text-error ms-4">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        {{--        <div class="mt-6 flex gap-x-10">--}}
        {{--            <button>--}}
        {{--                <div class="flex items-center">--}}
        {{--                    <img src="{{ Storage::url('website/profile/gif.svg') }}" alt="gif">--}}
        {{--                    <p class="ml-1 font-bold leading-5">Gif</p>--}}
        {{--                </div>--}}
        {{--            </button>--}}
        {{--            <button>--}}
        {{--                <div class="flex items-center">--}}
        {{--                    <img src="{{ Storage::url('website/profile/emoji.svg') }}" alt="gif">--}}
        {{--                    <p class="ml-1 font-bold leading-5">Emoji</p>--}}
        {{--                </div>--}}
        {{--            </button>--}}
        {{--            <button>--}}
        {{--                <div class="flex items-center">--}}
        {{--                    <img src="{{ Storage::url('website/profile/photo.svg') }}" alt="gif">--}}
        {{--                    <p class="ml-1 font-bold leading-5">Photo</p>--}}
        {{--                </div>--}}
        {{--            </button>--}}
        {{--            <button>--}}
        {{--                <div class="flex items-center">--}}
        {{--                    <img src="{{ Storage::url('website/profile/video.svg') }}" alt="gif">--}}
        {{--                    <p class="ml-1 font-bold leading-5">Video</p>--}}
        {{--                </div>--}}
        {{--            </button>--}}
        {{--        </div>--}}
    </div>
</div>
@unless($post->images->count()<=1)
    @script
    <script>

        Alpine.data('carousel{{$post->id}}',(id) => {
            return {
                selected: 0,
                carouselId: id,
                images: @json($post->images->pluck('url')),
                type: @json($post->images->pluck('file_type'))
            }
        });
    </script>
    @endscript
@endunless

