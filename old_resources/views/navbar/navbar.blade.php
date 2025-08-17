<div class="relative">
    <nav class="absolute z-10 w-full top-6">
        <div class="px-5">
            <div class="container mx-auto flex flex-column justify-between">
                <div class="self-center lg:basis-1/6">
                    <a class="flex" href="{{ route("home-page") }}">
                        <h1 class="text-white xl:text-3xl lg:text-2xl text-2xl md:ps-0">
                            LANDA TRIP
                        </h1>
                    </a>
                </div>
                <div class="flex justify-center lg:basis-4/6   md:text-end">
                    <div class=" xl:px-2 py-3 m-0 self-center  rounded-2xl text-DarkGray">
                        <div class="navbar-start lg:hidden ">
                            <div class="dropdown dropdown-end static z-50">
                                <details class="dropdown static">
                                    <summary class="btn shadow-inner shadow-white/40 bg-white bg-opacity-50 backdrop-opacity-95 backdrop-blur ">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 12h8m-8 6h16"/>
                                        </svg>
                                    </summary>
                                    <ul tabindex="0"
                                        class="text-xl menu-sm dropdown dropdown-content mt-3 flex flex-col text-center p-2 w-full shadow-inner shadow-white/40 bg-white/20 backdrop-opacity-95 backdrop-blur z-50 text-[#4F4F4F]">
                                        <li class="my-2">
                                            <a class="px-3 self-center text-xl @if(Route::is('home-page')) font-bold text-black @else text-white @endif"
                                                href="{{ route("home-page") }}">Home
                                            </a>
                                        </li>
                                        <li class="my-2">
                                            <a class="px-3 self-center text-xl @if(Route::is('about-us')) font-bold text-black @else text-white @endif"
                                                href="{{ route("about-us") }}">About
                                            </a>
                                        </li>
                                        <li class="my-2">
                                            <a class="px-3 self-center text-xl @if(Route::is('blog.index')) font-bold text-black @else text-white @endif"
                                                href="{{ route("blog.index") }}">Blog
                                            </a>
                                        </li>
                                        <li class="my-2">
                                            <a class="px-3 self-center text-xl @if(Route::is('verify.index')) font-bold text-black @else text-white @endif"
                                                href="{{ route('verify.index') }}">Verification
                                            </a>
                                        </li>
                                        <li class="my-2">
                                            <a class="px-3 self-center text-xl @if(Route::is('contact-us.index')) font-bold text-black @else text-white @endif"
                                                href="{{ route("contact-us.index") }}">contact us
                                            </a>
                                        </li>
                                        <div class="flex flex-row justify-center my-4 text-base">
                                            @auth
                                                @unless(auth()->user()->hasRole(["admin", "manager"]))
                                                    <!-- profile -->
                                                    <a href="{{ route('profile', auth()->user()) }}" class="btn btn-accent shadow-inner bg-white/20 backdrop-opacity-95 backdrop-blur border-white btn-sm  h-[2.5rem] rounded-2xl px-3.5">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                                            <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                            <path
                                                                d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
                                                        </svg>
                                                    </a>
                                                @endunless
                                                <!-- setting -->
                                                <a href="{{ route('login') }}" class="btn btn-accent shadow-inner bg-white/20 backdrop-opacity-95 backdrop-blur border-white mx-1.5 btn-sm h-[2.5rem] rounded-2xl px-3.5">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                                        <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                        <style>svg {
                                                                fill: #ffffff
                                                            }</style>
                                                        <path
                                                            d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z"/>
                                                    </svg>
                                                </a>
                                                <!-- logout -->
                                                <form action="{{ route('logout') }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-info bg-transparent hover:bg-/50 hover:text-black border-white btn-sm shadow-inner h-[2.5rem] rounded-2xl px-3.5">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                                            <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                            <path
                                                                d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @else
                                                <div class="mt-4">
                                                    <a href="{{ route('login') }}"
                                                        class="w-full text-center text-black px-6 py-3 border-solid border-2 border-white rounded-2xl mx-1.5 self-center hover:bg-white hover:text-black ease-out duration-300 font-medium">{{ __("Log In") }}
                                                    </a>
                                                    @if (Route::has('register'))
                                                        <a class="w-full text-center px-6 py-3 text-black border-solid border-2 border-white rounded-2xl bg-white mx-1.5 self-center font-medium hover:bg-[#0000] hover:text-white  ease-out duration-300"
                                                            aria-current="page" href="{{ route("register") }}">{{ __("Sign Up") }}
                                                        </a>
                                                    @endif
                                                </div>

                                            @endauth
                                            {{--                                        @includeIf('navbar.components.language-switcher')--}}
                                        </div>
                                    </ul>
                                </details>
                            </div>
                        </div>
                        <div class=" xl:px-2 py-3 m-0 self-center  rounded-2xl text-DarkGray shadow-white/40 bg-white bg-opacity-50 backdrop-opacity-95 backdrop-blur hidden lg:flex ">
                            <div class="navbar-center  ">
                                <ul class="menu-horizontal px-1 text-DarkGray">
                                    <li>
                                        <a class="xl:px-8 px-6 self-center hover:text-black @if(Route::is('home-page')) font-bold text-black @else  @endif"
                                            href="{{ route('home-page') }}">Home
                                        </a>
                                    </li>
                                    <!--<li>-->
                                    <!--    <a class="xl:px-8 px-6 self-center hover:text-black @if(Route::is('services')) font-bold text-black @else  @endif"-->
                                    <!--        href="">Services-->
                                    <!--    </a>-->
                                    <!--</li>-->
                                    <li>
                                        <a class="xl:px-8 px-6 self-center hover:text-black @if(Route::is('blog.index')) font-bold text-black @else  @endif"
                                            href="{{ route("blog.index") }}">Blog
                                        </a>
                                    </li>
                                    <li>
                                        <a class="xl:px-8 px-6 self-center hover:text-black @if(Route::is('contact-us.index')) font-bold text-black @else  @endif"
                                            href="{{ route('contact-us.index') }}">Contact us
                                        </a>
                                    </li>
                                    <li>
                                        <a class="xl:px-8 px-6 self-center hover:text-black @if(Route::is('about-us')) font-bold text-black @else  @endif"
                                            href="{{ route("about-us") }}">About Us
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-sm lg:flex lg:flex-column hidden items-center xl:w-[20%] w-[24%] justify-end ">
                    @auth
                        @unless(auth()->user()->hasRole(["admin", "manager"]))
                            <!-- profile -->
                            <a href="{{ route('profile', auth()->user()) }}" class="btn btn-accent shadow-inner bg-white/20 backdrop-opacity-95 backdrop-blur border-white btn-sm  h-[2.5rem] rounded-2xl px-3.5">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                                    <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path
                                        d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
                                </svg>
                            </a>
                        @endunless
                        <!-- setting -->
                        <a href="{{ route('login') }}" class="btn btn-accent shadow-inner bg-white/20 backdrop-opacity-95 backdrop-blur border-white mx-1.5 btn-sm h-[2.5rem] rounded-2xl px-3.5">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <style>svg {
                                        fill: #ffffff
                                    }</style>
                                <path
                                    d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z"/>
                            </svg>
                        </a>
                        <!-- logout -->
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-info bg-transparent hover:bg-/50 hover:text-black border-white btn-sm shadow-inner h-[2.5rem] rounded-2xl px-3.5">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                    <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path
                                        d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z"/>
                                </svg>
                            </button>
                        </form>
                    @else

                        <a href="{{ route('login') }}"
                            class="w-full text-center text-white px-4 py-3 border-solid border-2 border-white rounded-2xl mx-1.5 self-center hover:bg-white hover:text-black ease-out duration-300 font-medium">{{ __('Log In') }}</a>
                        @if (Route::has('register'))
                            <a class="w-full text-center px-4 py-3 text-black border-solid border-2 border-white rounded-2xl bg-white mx-1.5 self-center font-medium hover:bg-[#0000] hover:text-white  ease-out duration-300"
                                aria-current="page" href="{{ route("register") }}">{{ __('Sign Up') }}</a>
                        @endif
                    @endauth

                </div>
            </div>
        </div>
    </nav>
</div>
