<div class="w-full bg-white shadow-xl rounded-2xl">
    <div class="rounded-t-2xl h-32 overflow-hidden">
        <img class="object-cover object-top w-full" src="{{Storage::url("/users/header/" . $user->headerImage->url )}}"
             alt='header'>
    </div>
    <div class="container  mx-auto ">
        <div class="flex justify-between ">
            <div class="w-32 h-32 relative -mt-16 border-4 border-white rounded-full overflow-hidden">
                @if($user->profileImage)
                    <img class="object-cover rounded-full"
                         src="{{ Storage::url('/users/profile/' . $user->profileImage?->url) }}"
                         alt="{{ asset('/users/profile/' . $user->profileImage?->alt) }}">
                @else
                    <img class="object-cover rounded-full"
                         src="{{ Storage::url('/users/profile/') }}/{{ $user->sex === 2 ? "female.png" : "male.png" }}"
                         alt="{{ $user->name }}">
                @endif
            </div>
            <div>
                <ul class="py-4 mt-2 text-gray-700 flex items-center justify-around gap-x-14">
                    <li class="flex flex-col items-center justify-around text-xl font-bold gap-y-2">
                        12
                        <div>Posts</div>
                    </li>
                    <li class="flex flex-col items-center justify-around text-xl font-bold gap-y-2">
                        {{ $user->followers()->count() }}
                        <div>{{ __('pages/profile.followings') }} </div>
                    </li>
                    <li class="flex flex-col items-center justify-around text-xl font-bold gap-y-2">
                        {{ $user->followers()->count() }}
                        <div>{{ __('pages/profile.followers') }}</div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex justify-between">
            <div class="">
                <p class="font-bold text-2xl">{{ $user->fname }} {{ $user->lname }}</p>
                <p class="text-darkGray font-bold text-base mt-1">{{ $user->title }}</p>
            </div>
            <div class="flex justify-end -space-x-4 rtl:space-x-reverse">
                <img class="w-8 h-8 border-2 border-white rounded-full "
                     src="{{Storage::url("/website/profile/avatar1.png")}}" alt="">
                <img class="w-8 h-8 border-2 border-white rounded-full "
                     src="{{Storage::url("/website/profile/avatar1.png")}}" alt="">
                <img class="w-8 h-8 border-2 border-white rounded-full "
                     src="{{Storage::url("/website/profile/avatar1.png")}}" alt="">
                <a class="flex items-center justify-center w-8 h-8 text-md font-medium text-mediumGray bg-lightGray border-2 border-mediumGray rounded-full"
                   href="#">+4</a>
            </div>
        </div>
        <div>
            <p class="text-sm my-5 text-ellipsis overflow-hidden">
                {{$user->about_me}}
            </p>
        </div>
        <div class="flex justify-between">
            <div class="flex gap-5">
                <img src="{{Storage::url("/website/profile/instagram.svg")}}">
                <img src="{{Storage::url("/website/profile/facebook.svg")}}">
                <img src="{{Storage::url("/website/profile/LinkedIn.svg")}}">
            </div>
            <div class="flex items-center gap-5 pb-5">
                <button class="btn bg-orange text-white font-bold text-base rounded-2xl w-28">Follow</button>
                <button class="btn bg-white text-orange font-bold text-base border-2 border-orange rounded-2xl w-28">Message</button>
                <button>
                    <img src="{{Storage::url('website/profile/moreButton.svg')}}">
                </button>
            </div>
        </div>
    </div>
</div>


{{--<div class="w-100 text-center p-3 bg-light rounded-3 shadow-lg top-0 mb-4 border-dark-gray">--}}
{{--    <div class="mx-auto ratio ratio-1x1 max-w-9rem mb-4">--}}
{{--        @if($user->profileImage)--}}
{{--            <img class="object-fit-cover rounded-full" src="{{ asset('/users/profile/' . $user->profileImage?->url) }}"--}}
{{--                 alt="{{ asset('/users/profile/' . $user->profileImage?->alt) }}">--}}
{{--        @else--}}
{{--            <img class="object-fit-cover rounded-full"--}}
{{--                 src="{{ asset('/users/profile/') }}/{{ $user->sex === 2 ? "female.png" : "male.png" }}"--}}
{{--                 alt="{{ $user->name }}">--}}
{{--        @endif--}}
{{--    </div>--}}
{{--    <h1 class="h5 text-black">{{ $user->fname }} {{ $user->lname }}</h1>--}}
{{--    <p class="fs- mb-1 text-dark-gray">{{ $user->title }}</p>--}}
{{--    @if( $user->hasRole('teacher'))--}}
{{--        <p class="fs-3  text-dark">Role <b>Teacher</b></p>--}}
{{--    @else--}}
{{--        <p class="fs-3  text-dark">Role <b>User</b></p>--}}
{{--    @endif--}}
{{--    <div class="d-flex justify-content-around text-center fs-2 fw-bold">--}}
{{--        <div>{{ __('pages/profile.followers') }} {{ $user->followers()->count() }}</div>--}}
{{--        <div>{{ __('pages/profile.followings') }} {{ $user->following()->count() }}</div>--}}
{{--    </div>--}}
{{--    <hr class="border-dark-gray">--}}
{{--    @includeIf('profile.components.user_info')--}}
{{--    <hr class="border-dark-gray">--}}
{{--    @includeIf('profile.components.user_education_background')--}}
{{--    @includeIf('profile.components.user_work_experience')--}}
{{--</div>--}}
{{--@includeIf('profile.components.user_map')--}}


{{--#attributes: array:26 [▼--}}
{{--"id" => "01hez1t3wddmyd3zcqn7qm2ywm"--}}
{{--"fname" => "mohammad amin"--}}
{{--"lname" => "asgarian"--}}
{{--"slug" => "mohammad-amin-asgarian"--}}
{{--"title" => "Full Stack Developer"--}}
{{--"birthday" => null--}}
{{--"email" => "asgarianm17@gmail.com"--}}
{{--"email_verified_at" => "2023-11-11 11:20:47"--}}
{{--"phone_number" => null--}}
{{--"phone_number_verified_at" => null--}}
{{--"verification_code" => null--}}
{{--"verification_code_expire" => null--}}
{{--"password" => "$2y$10$ydX5AZVNXhCua0SFMEhoUeT2fLaxVKWTvhypCs11AIhIPEYIVwG3e"--}}
{{--"two_factor_secret" => null--}}
{{--"two_factor_recovery_codes" => null--}}
{{--"two_factor_confirmed_at" => null--}}
{{--"location" => "12"--}}
{{--"sex" => 0--}}
{{--"about_me" => "As a 20-year-old React frontend web developer with two years of experience at Forough Roshan Company, I am highly motivated and hardworking. I have completed se ▶"--}}
{{--"skills" => "["react","php"]"--}}
{{--"score" => 90--}}
{{--"provider" => 0--}}
{{--"suspended" => 0--}}
{{--"remember_token" => null--}}
{{--"created_at" => "2023-11-11 11:20:57"--}}
{{--"updated_at" => "2023-11-11 11:20:57"--}}
{{--]--}}