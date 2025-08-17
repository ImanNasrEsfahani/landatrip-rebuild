<div class="my-20">
    <div class="relative bg-white shadow-xl rounded-2xl">
        <div class="flex items-end justify-end">
            <a class="static btn btn-white shadow-white/40 bg-white bg-opacity-50 backdrop-opacity-95 backdrop-blur z-50 m-5">
                <img src="{{ Storage::url('/website/profile/share.svg') }}">
            </a>
            @if($user->headerImage)
                <img
                    class="absolute z-10 w-full aspect-video top-0 overflow-hidden h-[14rem] object-cover rounded-t-2xl"
                    src="{{ Storage::url('/users/header/'.$user->headerImage->url) }}">
            @else
                <img
                    class="absolute z-10 w-full aspect-video top-0 overflow-hidden h-[14rem] object-cover rounded-t-2xl"
                    src="{{ Storage::url('/users/header/default.webp') }}">
            @endif
        </div>
        <div class="flex flex-col md:flex-row">
            <div class="relative z-50 flex flex-col md:w-1/3 w-full items-center">
                @if($user->profileImage)
                    <img class="w-[11rem] aspect-square object-cover rounded-full ms-10 mt-10 me-10 border border-white border-2"
                        src="{{ Storage::url('/users/profile/'.$user->profileImage->url) }}"
                        alt="{{ $user->fname." ".$user->lname }}">
                @else
                    <img class="w-[11rem] aspect-square object-cover rounded-full ms-10 mt-10 me-10"
                        src="{{ Storage::url('/users/profile/'.($user->sex->value?"male.webp":"female.webp")) }}"
                        alt="{{ $user->fname." ".$user->lname }}">
                @endif
                <h1 class="text-center text-2xl font-semibold mt-4">
                    {{ $user->fname." ".$user->lname }}
                </h1>
                <h2 class="text-lg text-center">
                    {{ $user->title }}
                </h2>
            </div>
            <div class="relative z-50 flex flex-col md:w-2/3 w-full md:items-end items-center">
                <div class="flex flex-row-reverse md:mt-[9rem] md:me-8 gap-8">
                    <button @click="$dispatch('followerpopup')">
                    <div class="w-fit flex flex-col gap-3 items-center py-4">
                        <span class="text-2xl font-semibold ">{{ $user->followers->count() }}</span>
                        <span class="text-2xl font-light">Followers</span>
                    </div>
                    </button>
                    <button @click="$dispatch('followerpopup')">
                    <div class="w-fit flex flex-col gap-3 items-center py-4">
                        <span class="text-2xl font-semibold ">{{ $user->following->count() }}</span>
                        <span class="text-2xl font-light">Following</span>
                    </div>
                    </button>
                    <div class="w-fit flex flex-col gap-3 items-center py-4">
                        <span class="text-2xl font-semibold md:px-0 px-8 ">{{ $user->userPosts->count() }}</span>
                        <span class="text-2xl font-light">Posts</span>
                    </div>
                </div>
                <div class="mt-8 me-8">
                    @if(auth()->user()->followers()->whereIn('follower_id', $user->followers->pluck('id'))->count() && !(auth()?->user()->id == $user->id))
                        <div class="avatar-group flex -space-x-3 rtl:space-x-reverse">
                            @foreach(auth()->user()->followers()->whereIn('follower_id', $user->followers->pluck('id'))->get()->slice(0, 5) as $index => $item)
                                <img class="w-8 aspect-square rounded-full border @if($item->hasRole(['user'])) border-secondary @else border-primary @endif "
                                    src="{{ Storage::url('/users/profile/'.$item->profileImage->url) }}"/>
                            @endforeach
                            @if(auth()->user()->followers()->whereIn('follower_id', $user->followers->pluck('id'))->count() > 5)
                                <a class="flex items-center justify-center w-8 border border-info text-info text-xs font-medium bg-lightGray rounded-full">+{{ $user->followers->count() - 5 }}</a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

        </div>
        @if($user->about_me)
            <div class="my-8"  x-data="{ open: false, maxLength: 400, fullText: '', slicedText: '' }"
                x-init="fullText = $el.firstElementChild.textContent.trim(); slicedText = fullText.slice(0, maxLength)" >
                <div   class="block" >
                    <p class="px-5 text-lg leading-6 text-black" x-text="open ? fullText : slicedText" x-transition>{{ $user->about_me }}</p>
                    <div class="ms-5">
                        <button x-show="fullText.length>maxLength"   class="text-lg font-bold text-gray" @click="open = ! open" x-text="open ? 'Show less' : 'more...'"></button>
                    </div>
                </div>
            </div>
        @endif
        <div class="flex md:flex-row flex-col md:justify-between justify-center items-center pb-8 gap-6">
            <div class="flex flex-row gap-8 mx-10 ">
                @forelse($user->socialMedia as $item)
                    <a href="{{ $item->pivot->address }}" class="border-2 border-secondary rounded-lg p-2">
                        <img class="text-secondary w-[1rem]"
                            src="{{ Storage::url('/website/social-media-icon/'.$item->path) }}" alt="">
                    </a>
                @empty
                @endforelse
            </div>
            <div class="flex flex-row-reverse gap-5 mx-10">
                <a class="rounded-full border border-mediumGray" href="">
                    <img class="" src="{{ Storage::url('/website/profile/more.svg') }}" alt="">
                </a>
                @unless(auth()->user()?->id == $this->user->id)
                    <button wire:click="login" class="bg-white text-secondary rounded-xl py-2 px-5 flex flex-row gap-2 hover:text-white hover:bg-secondary border border-secondary ease-out duration-300">
                        <img class="text-white" src="{{ Storage::url('/website/profile/send-2.svg') }}">
                        Massage
                    </button>
                    <button wire:click="follow" class="text-white rounded-xl py-2 px-6 hover:text-secondary hover:bg-white border border-secondary ease-out duration-300 @if($isFollowing) bg-primary border-none @else bg-secondary @endif">
                        {{ auth()->user()? ($isFollowing ? "UnFollow" : ($isFollowed ? "Follow Back" : "Follow")) : "Follow"}}
                    </button>
                @endunless
            </div>
        </div>
    </div>
</div>
