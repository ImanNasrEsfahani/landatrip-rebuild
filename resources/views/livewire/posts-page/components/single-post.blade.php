<div id="{{ $post->id }}" class="shadow-xl pt-8 rounded-2xl mb-6" wire:key="{{ $post->id }}">
    @php($isLiked = $post->userPostLikes()->where("user_id", "=", auth()->user()->id)->count())
    @php($isSaved = $post->usersPostSaved()->where("user_id", "=", auth()->user()->id)->count())
    <div class="flex mx-8 mb-6">
        <div>
            <img class="w-12 h-12 rounded-full border @if($user->hasRole(['user'])) border-secondary @else border-primary @endif " src="{{ Storage::url('/users/profile/'.$user->profileImage->url) }}" alt="{{ $user->fname." ".$user->lname }}">
        </div>
        <div class="ml-5">
            <P class="text-2xl font-bold leading-8">{{ $user->fname." ".$user->lname }}</P>
            <p class="text-base font-bold leading-5 text-[#646665]">North America - 5 hours ago</p>
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
        <img class="w-full aspect-video object-cover" src="{{ Storage::url('posts/'.$post->images[0]->url) }}" alt="svg">
{{--        <video class="w-full h-[30rem] rounded-lg" >--}}
{{--            <source src="{{ Storage::url('website/profile/movie.mp4') }}" type="video/mp4">--}}
{{--        </video>--}}
    <div class="flex items-center p-2 rounded-xl  absolute left-3 bottom-3 bg-white bg-opacity-50 backdrop-opacity-95 backdrop-blur">
{{--        <img class="w-16 h-16 rounded-full" src="{{ Storage::url('/groups/thumbnails/'.$post->group->thumbnailImage->url) }}" alt="img">--}}
        <div class="flex flex-col justify-center items-center ml-4">
            <p class="font-EB Garamond ">jafar</p>
            <div class="flex">
                <img src="{{ Storage::url('website/profile/location.svg') }}" alt="svg">
                <p>Rasht, Iran</p>
            </div>
        </div>
    </div>
</div>
<div class="px-6 py-4 flex ">
    <div class="flex items-center">
        <button wire:click="like($post)">
            <div class="p-1 @if($isLiked) bg-red-500 @else bg-lightGray @endif rounded-lg">
                <svg class="@if($isLiked) fill-white @else fill-accent @endif" width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.89062 18.4897V8.32973C8.89062 7.92973 9.01062 7.53973 9.23062 7.20973L11.9606 3.14973C12.3906 2.49973 13.4606 2.03973 14.3706 2.37973C15.3506 2.70973 16.0006 3.80973 15.7906 4.78973L15.2706 8.05973C15.2306 8.35973 15.3106 8.62973 15.4806 8.83973C15.6506 9.02973 15.9006 9.14973 16.1706 9.14973H20.2806C21.0706 9.14973 21.7506 9.46973 22.1506 10.0297C22.5306 10.5697 22.6006 11.2697 22.3506 11.9797L19.8906 19.4697C19.5806 20.7097 18.2306 21.7197 16.8906 21.7197H12.9906C12.3206 21.7197 11.3806 21.4897 10.9506 21.0597L9.67062 20.0697C9.18062 19.6997 8.89062 19.1097 8.89062 18.4897Z" />
                    <path d="M5.71 6.37988H4.68C3.13 6.37988 2.5 6.97988 2.5 8.45988V18.5199C2.5 19.9999 3.13 20.5999 4.68 20.5999H5.71C7.26 20.5999 7.89 19.9999 7.89 18.5199V8.45988C7.89 6.97988 7.26 6.37988 5.71 6.37988Z" />
                </svg>
            </div>
        </button>
        <p class="ml-1 font-light text-lg leading-6 text-info">{{ $post->userPostLikes->count() }} Like</p>
    </div>
    <div class="flex items-center ml-auto">
        <img src="{{ Storage::url('website/profile/message.svg') }}" alt="svg">
        <p class="ml-1 font-light text-lg leading-6 text-info">{{ $post->userPostComments->count() }} Comment</p>
    </div>
    <div class="flex items-center ml-12">
        <img src="{{ Storage::url('website/profile/send2.svg') }}" alt="svg">
        <p class="ml-1 font-light text-lg leading-6 text-info">12 share</p>
    </div>
</div>
<p class="px-5 text-xl font-bold leading-6 text-black">{{ $post->title }}<span class="text-lg font-bold text-[#A0A3A2]">see more...</span></p>
{{--<p class="text-[#007560] text-end mt-1 px-6 font-bold leading-5">See translation</p>--}}
<div class="py-6 px-4 border-t mt-2 ">
    <div class="overflow-y-scroll scrollbarInputs max-h-[37rem]">
        {{-- ------------------------comments--------------------- --}}
            <div class="flex items-start ">
                <img class="w-12 h-12 rounded-full border-2 border-[#FF8C00]" src="{{ Storage::url('/users/profile/'.$user->profileImage->url) }}" alt="">
                <div class="ml-4">
                    <div class="py-2 px-4 rounded-xl bg-[#F1F2F2] inline-block  border-l-4 border-[#FF8C00]">
                        <p class="font-bold leading-5">Lara Max</p>
                        <p class="mt-2 font-bold text-[14px] leading-6">This is really killing two birds with one stone.</p>
                    </div>
                    <div class="mt-2 divide-x-2 flex">
                        <div class="flex items-center pr-2">
                            <img src="{{ Storage::url('website/profile/like2.svg') }}" alt="like">
                            <p class="ml-1 font-bold text-[14px] leading-6 text-[#646665]">2</p>
                        </div>
                        <div class="flex items-center pl-2">
                            <img src="{{ Storage::url('website/profile/undo.svg') }}" alt="like">
                            <p class="ml-1 font-bold text-[14px] leading-6 text-[#646665]">2</p>
                            <p class="ml-2 font-bold text-[14px] leading-6 text-[#646665]">Reply</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-start mt-5">
                <img class="w-12 h-12 rounded-full border-2 border-[#007560]" src="{{ Storage::url('/users/profile/'.$user->profileImage->url) }}" alt="">
                <div class="ml-4">
                    <div class="py-2 px-4 rounded-xl bg-[#F1F2F2] inline-block  border-l-4 border-[#007560]">
                        <p class="font-bold leading-5">Lara Max</p>
                        <p class="mt-2 font-bold text-[14px] leading-6">This is really killing two birds with one stone.</p>
                    </div>
                    <div class="mt-2 divide-x-2 flex">
                        <div class="flex items-center pr-2">
                            <img src="{{ Storage::url('website/profile/like2.svg') }}" alt="like">
                            <p class="ml-1 font-bold text-[14px] leading-6 text-[#646665]">2</p>
                        </div>
                        <div class="flex items-center pl-2">
                            <img src="{{ Storage::url('website/profile/undo.svg') }}" alt="like">
                            <p class="ml-1 font-bold text-[14px] leading-6 text-[#646665]">2</p>
                            <p class="ml-2 font-bold text-[14px] leading-6 text-[#646665]">Reply</p>
                        </div>
                    </div>
                </div>
            </div>
        {{-- ------------------------end of comments--------------------- --}}
        {{-- -----------------replay----------------- --}}
        <div class="ml-16 pl-3 border-l-[3px] border-[#D9D9D9]">
            <div class="flex items-start mt-5 ">
                <img class="w-12 h-12 rounded-full border-2 border-[#646665]" src="{{ Storage::url('/users/profile/'.$user->profileImage->url) }}" alt="">
                <div class="ml-4">
                    <div class="py-2 px-4 rounded-xl bg-[#F1F2F2] inline-block  border-l-4 border-[#646665]">
                        <p class="font-bold leading-5">Lara Max</p>
                        <p class="mt-2 font-bold text-[14px] leading-6">This is really killing two birds with one stone.</p>
                    </div>
                    <div class="mt-2">
                        <div class="flex items-center pr-2">
                            <img src="{{ Storage::url('website/profile/like2.svg') }}" alt="like">
                            <p class="ml-1 font-bold text-[14px] leading-6 text-[#646665]">2</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" flex items-start mt-5 ">
                <img class="w-12 h-12 rounded-full border-2 border-[#646665]" src="{{ Storage::url('/users/profile/'.$user->profileImage->url) }}" alt="">
                <div class="ml-4">
                    <div class="py-2 px-4 rounded-xl bg-[#F1F2F2] inline-block  border-l-4 border-[#646665]">
                        <p class="font-bold leading-5">Lara Max</p>
                        <p class="mt-2 font-bold text-[14px] leading-6">This is really killing two birds with one stone.</p>
                    </div>
                    <div class="mt-2">
                        <div class="flex items-center pr-2">
                            <img src="{{ Storage::url('website/profile/like2.svg') }}" alt="like">
                            <p class="ml-1 font-bold text-[14px] leading-6 text-[#646665]">2</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- -----------------end of replay----------------- --}}
    </div>
</div>
<div class="shadow-2xl px-7 py-5 mt-6 rounded-2xl">
    <div class="flex items-center">
        <img class="w-12 h-12 rounded-full border-2 border-[#007560]" src="{{ Storage::url('/users/profile/'.$user->profileImage->url) }}" alt="jafar">
        <div class="ml-3 rounded-3xl w-full bg-[#F1F2F2] px-5 flex">
            <input class="input rounded-3xl bg-[#F1F2F2] w-full focus:outline-0 text-lg text-[#A0A3A2] font-normal" placeholder="what do you want to talk about?" type="text" />
            <button>
                <img  src="{{ Storage::url('website/profile/send.svg') }}" alt="">
            </button>
        </div>
    </div>
    <div class="mt-6 flex gap-x-10">
        <button>
            <div class="flex items-center">
                <img src="{{ Storage::url('website/profile/gif.svg') }}" alt="gif">
                <p class="ml-1 font-bold leading-5">Gif</p>
            </div>
        </button>
        <button>
            <div class="flex items-center">
                <img src="{{ Storage::url('website/profile/emoji.svg') }}" alt="gif">
                <p class="ml-1 font-bold leading-5">Emoji</p>
            </div>
        </button>
        <button>
            <div class="flex items-center">
                <img src="{{ Storage::url('website/profile/photo.svg') }}" alt="gif">
                <p class="ml-1 font-bold leading-5">Photo</p>
            </div>
        </button>
        <button>
            <div class="flex items-center">
                <img src="{{ Storage::url('website/profile/video.svg') }}" alt="gif">
                <p class="ml-1 font-bold leading-5">Video</p>
            </div>
        </button>
    </div>
</div>
</div>
