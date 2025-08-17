<div>
    @if($user->skills)
        <div class="bg-white shadow-xl rounded-2xl p-5">
            <h2 class="text-primary flex items-start text-2xl font-semibold my-4">
                Skills </h2>
            <ul class="flex flex-wrap gap-x-3 gap-y-2 font-normal text-darkGray">
                @forelse($user->skills as $skill)
                    <li>
                        <a class="px-2 py-1 bg-lightGray rounded-lg  flex">
                            <span class="text-xl self-center pe-1"># </span>{{$skill}}
                        </a>
                    </li>
                @empty
                @endforelse
            </ul>
        </div>
    @endif
    <div x-data="{showAll:false, buttonText:'Show more <span> > </span>'}" class="bg-white shadow-xl rounded-2xl pt-3 mt-5">
        <h2 class="text-primary flex items-start text-2xl font-semibold mt-4 px-5">Join Trips</h2>
        <div class="px-5 mb-5">
            @forelse($groups as $group)
                <div @if($loop->index>2) x-show="showAll" x-transition.duration.300ms
                    @endif class="flex flex-col gap-5 my-3 relative">
                    <a href="{{ route('tour.show', $group->tour->slug) }}" class="after:absolute after:inset-0"></a>
                    <div class="flex md:flex-row flex-col gap-2 bg-white shadow rounded-xl">
                        <img
                            class="md:w-[40%] w-full md:rounded-s-2xl aspect-video object-cover rounded-t-2xl md:rounded-tr-none"
                            alt="" src="{{ Storage::url('/groups/thumbnails/'.$group->thumbnailImage->url) }}">
                        <div class="flex flex-col justify-between w-full">
                            <h2 class="text-lg font-semibold md:text-start text-center line-clamp-1">{{ $group->title }}</h2>
                            <div class="flex flex-row flex-wrap justify-between py-2 md:px-0 px-4">
                                <div class="flex flex-row">
                                    <img class="w-4" src="{{ Storage::url('/website/profile/location.svg')}}">
                                    <span class="text-xs">
                                    {{ $group->tour->city->name }}
                                </span>
                                    <span class="text-xs">
                                    , {{ $group->tour->city->country->name }}
                                </span>
                                </div>
                                <div class="flex flex-row me-2">
                                    <img class="w-4" src="{{ Storage::url('/website/profile/calendar-2.svg')}}">
                                    <span class="text-xs">
                                    {{ $group->start_registration_date }}
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
        @if($groups->count()>3)
            <div class="text-center py-2  shadow rounded-b-2xl">
                <button
                    x-on:click="showAll= !showAll;if(showAll){buttonText='Show less<span> > </span>'}else{buttonText='Show more<span> > </span>'}"
                    x-html="buttonText" class="font-medium text-center"></button>
            </div>
        @endif
    </div>
        @if(false)
            <div x-data="{showAll:false, buttonText:'Show more <span> > </span>'}" class="bg-white shadow-xl rounded-2xl my-5 pt-2">
                <h2 class="text-primary flex items-start text-2xl font-semibold mt-4 px-5">Communities</h2>
                <div class="px-5 mb-5">
                    @forelse($user->communities as $community)
                        <div @if($loop->index>2) x-show="showAll" x-transition.duration.300ms
                            @endif class="flex flex-col gap-5 my-3 relative">
                            <a href="{{ route('community.show', $community->slug) }}" class="after:absolute after:inset-0"></a>
                            <div class="flex md:flex-row flex-col gap-2 bg-white shadow rounded-xl">
                                <img
                                    class="w-full md:w-[15rem] md:rounded-s-2xl aspect-video object-cover rounded-t-2xl md:rounded-tr-none"
                                    alt="" src="{{ Storage::url('/communities/thumbnails/'.$community->thumbnailImage->url) }}">
                                <div class="flex flex-col justify-between w-full">
                                    <h2 class="text-lg font-semibold md:text-start text-center line-clamp-1">{{ $community->title }}</h2>
                                    <div class="flex flex-row flex-wrap justify-between py-2 md:px-0 px-4">
                                        <div class="flex flex-row items-center">
                                            <svg width="17" height="16" viewBox="0 0 17 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M6.4987 1.33301C4.75203 1.33301 3.33203 2.75301 3.33203 4.49967C3.33203 6.21301 4.67203 7.59967 6.4187 7.65967C6.47203 7.65301 6.52536 7.65301 6.56536 7.65967C6.5787 7.65967 6.58536 7.65967 6.5987 7.65967C6.60536 7.65967 6.60536 7.65967 6.61203 7.65967C8.3187 7.59967 9.6587 6.21301 9.66536 4.49967C9.66536 2.75301 8.24536 1.33301 6.4987 1.33301Z"
                                                    fill="#A0A3A2"/>
                                                <path
                                                    d="M9.88469 9.43293C8.02469 8.19293 4.99135 8.19293 3.11802 9.43293C2.27135 9.9996 1.80469 10.7663 1.80469 11.5863C1.80469 12.4063 2.27135 13.1663 3.11135 13.7263C4.04469 14.3529 5.27135 14.6663 6.49802 14.6663C7.72469 14.6663 8.95135 14.3529 9.88469 13.7263C10.7247 13.1596 11.1914 12.3996 11.1914 11.5729C11.1847 10.7529 10.7247 9.99293 9.88469 9.43293Z"
                                                    fill="#A0A3A2"/>
                                                <path
                                                    d="M13.8263 4.89307C13.9329 6.18641 13.0129 7.31974 11.7396 7.47307C11.7329 7.47307 11.7329 7.47307 11.7263 7.47307H11.7062C11.6662 7.47307 11.6262 7.47307 11.5929 7.48641C10.9462 7.51974 10.3529 7.31307 9.90625 6.93307C10.5929 6.31974 10.9863 5.39974 10.9062 4.39974C10.8596 3.85974 10.6729 3.36641 10.3929 2.94641C10.6463 2.81974 10.9396 2.73974 11.2396 2.71307C12.5463 2.59974 13.7129 3.57307 13.8263 4.89307Z"
                                                    fill="#A0A3A2"/>
                                                <path
                                                    d="M15.1615 11.0599C15.1081 11.7066 14.6948 12.2666 14.0015 12.6466C13.3348 13.0133 12.4948 13.1866 11.6615 13.1666C12.1415 12.7333 12.4215 12.1933 12.4748 11.6199C12.5415 10.7933 12.1481 9.99994 11.3615 9.36661C10.9148 9.01327 10.3948 8.73327 9.82812 8.52661C11.3015 8.09994 13.1548 8.38661 14.2948 9.30661C14.9081 9.79994 15.2215 10.4199 15.1615 11.0599Z"
                                                    fill="#A0A3A2"/>
                                            </svg>
                                            <span class="text-xs ms-1">{{ $community->users->count()}} Following</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
                @if($user->communities->count()>3)
                    <div class="text-center py-2  shadow rounded-b-2xl">
                        <button
                            x-on:click="showAll= !showAll;if(showAll){buttonText='Show less<span> > </span>'}else{buttonText='Show more<span> > </span>'}"
                            x-html="buttonText" class="font-medium text-center"></button>
                    </div>
                @endif
            </div>
        @endif
        @if($traveledUser->count())
            <div x-data="{showAllUser:false, buttonText:'Show more <span> > </span>'}" class="bg-white shadow-xl rounded-2xl mb-10">
                <h2 class="text-primary text-2xl font-semibold mt-4 px-5">The people who traveled with <span class="text-secondary">{{ $user->fname }}</span>, may you know</h2>
                <div class="px-5 mb-5">
                    @forelse($traveledUser as $user)
                        <div @if($loop->index>4) x-show="showAllUser" x-transition.duration.300ms @endif class="flex flex-col gap-3 my-2 relative">
                            <a href="{{ route('profile', $user->slug) }}" wire:navigate.hover class="after:absolute after:inset-0"></a>
                            <div class="flex md:flex-row flex-col gap-2 bg-white shadow rounded-xl p-3">
                                <img
                                    class="rounded-full w-[3rem] border @if($user->hasRole(['user'])) border-secondary @else border-primary @endif "
                                    alt="{{ $user->fname }}" src="{{ Storage::url('/users/profile/'.$user->profileImage->url) }}">
                                <div>
                                    <h3 class="text-lg font-semibold md:text-start text-center line-clamp-1">{{ $user->fname.' '.$user->lname }}</h3>
                                    <h4 class="text-sm font-light md:text-start text-center line-clamp-1">{{ $user->title }}</h4>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
                @if($traveledUser->count()>5)
                    <div class="text-center py-2  shadow rounded-b-2xl">
                        <button
                            x-on:click="showAllUser= !showAllUser;if(showAllUser){buttonText='Show less<span> > </span>'}else{buttonText='Show more<span> > </span>'}"
                            x-html="buttonText" class="font-medium text-center"></button>
                    </div>
                @endif
            </div>
        @endif
</div>
