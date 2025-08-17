<div>
    @includeIf('livewire.profile.components.nav-image')
    <div class="mx-auto container flex lg:justify-between justify-center items-center lg:items-start lg:flex-row-reverse flex-col gap-4">
        <div class="lg:w-[33%] md:w-3/4 w-full flex flex-col gap-5 ">
        @includeIf('livewire.profile.components.nav')
        </div>
        <div class="flex flex-col gap-5 lg:w-[67%] w-full mb-20">
            @includeIf('livewire.profile.components.profile-details')
            @includeIf('livewire.profile.components.badge')
            @if(auth()->user()?->id == $this->user->id)
                @includeIf('livewire.profile.components.new-post')
            @endif
            @if(!$user->userPrivacy->where("privacy_policy_id", 1)->where("status", \App\Enums\PrivacyPolicyEnum::private)->count() || (auth()->user() && $isFollowing) || (auth()->user()?->id == $this->user->id))
                @includeIf('livewire.profile.components.posts')
            @else
                <div class="text-center mt-10">
                    <div class="flex items-center justify-center">
                        <svg class="fill-info" width="49" height="48" viewBox="0 0 49 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M30.5 23.4995C29.68 23.4995 29 22.8195 29 21.9995V19.9995C29 17.0795 28.28 15.4995 24.5 15.4995C20.72 15.4995 20 17.0795 20 19.9995V21.9995C20 22.8195 19.32 23.4995 18.5 23.4995C17.68 23.4995 17 22.8195 17 21.9995V19.9995C17 18.1395 17 12.4995 24.5 12.4995C32 12.4995 32 18.1395 32 19.9995V21.9995C32 22.8195 31.32 23.4995 30.5 23.4995Z" />
                            <path d="M24.4968 30.7008C23.0168 30.7008 21.7969 29.4808 21.7969 28.0008C21.7969 26.5208 23.0168 25.3008 24.4968 25.3008C25.9768 25.3008 27.1968 26.5208 27.1968 28.0008C27.1968 29.4808 25.9768 30.7008 24.4968 30.7008ZM24.4968 27.7008C24.3368 27.7008 24.1968 27.8408 24.1968 28.0008C24.1968 28.3408 24.7969 28.3408 24.7969 28.0008C24.7969 27.8408 24.6568 27.7008 24.4968 27.7008Z" />
                            <path d="M29.5 35.5005H19.5C14.7 35.5005 13 33.8005 13 29.0005V27.0005C13 22.2005 14.7 20.5005 19.5 20.5005H29.5C34.3 20.5005 36 22.2005 36 27.0005V29.0005C36 33.8005 34.3 35.5005 29.5 35.5005ZM19.5 23.5005C16.32 23.5005 16 23.8205 16 27.0005V29.0005C16 32.1805 16.32 32.5005 19.5 32.5005H29.5C32.68 32.5005 33 32.1805 33 29.0005V27.0005C33 23.8205 32.68 23.5005 29.5 23.5005H19.5Z" />
                            <path d="M24.5 45.5005C12.64 45.5005 3 35.8605 3 24.0005C3 12.1405 12.64 2.50049 24.5 2.50049C36.36 2.50049 46 12.1405 46 24.0005C46 35.8605 36.36 45.5005 24.5 45.5005ZM24.5 5.50049C14.3 5.50049 6 13.8005 6 24.0005C6 34.2005 14.3 42.5005 24.5 42.5005C34.7 42.5005 43 34.2005 43 24.0005C43 13.8005 34.7 5.50049 24.5 5.50049Z" />
                        </svg>
                        <p class="font-bold text-info">This page is private</p>
                    </div>
                    <p class="font-bold text-gray">Follow this account to see More</p>
                </div>
            @endif
        </div>
    </div>
    @includeIf('livewire.profile.components.login-popup')
    @includeIf('livewire.profile.components.draft-popup')
</div>


