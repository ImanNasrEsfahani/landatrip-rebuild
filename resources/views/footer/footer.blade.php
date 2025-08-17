<footer class="bg-footer text-white">
    <div class="container mx-auto py-16">
        <div class="text-center md:text-left">
            <h1 class="text-3xl md:text-2xl mb-16">
                LANDA TRIP
            </h1>
            <div class="flex flex-col xl:flex-row justify-between xl:gap-28 px-4 md:px-0">
                <div class="flex flex-col gap-y-8 md:flex-row grow">
                    <div class="flex flex-col basis-1/3 text-white">
                        <header class="text-mediumGray text-xl md:text-lg">
                            Quick Access
                        </header>
                        <ul class="flex flex-col text-lg md:text-base pt-3 md:pt-4 gap-y-2">
                            <li><a href="{{ route('home-page') }}">Home</a></li>
                            <li><a href="{{ route('blog.index') }}">Blogs</a></li>
                            <li><a href="{{route('about-us')}}">About Us</a></li>
                            <li><a href="{{ route('contact-us.index') }}">Contact Us</a></li>
                        </ul>
                    </div>
                    <!--<div class="flex flex-col basis-1/3 pt-7 md:pt-0">-->
                    <!--    <header class="text-mediumGray text-xl md:text-lg">-->
                    <!--        Support-->
                    <!--    </header>-->
                    <!--    <ul class="flex flex-col text-lg md:text-base pt-3 md:pt-4 gap-y-2">-->
                    <!--        <li><a href="#">Pricing</a></li>-->
                    <!--        <li><a href="#">Documentation</a></li>-->
                    <!--        <li><a href="#">Guides</a></li>-->
                    <!--        <li><a href="#">Contact us</a></li>-->
                    <!--    </ul>-->
                    <!--</div>-->
                    <div class="flex flex-col basis-1/3 pt-7 md:pt-0">
                        <header class="text-mediumGray text-xl md:text-lg">
                            Address
                        </header>
                        <div class="">
                            <dl class="flex flex-col gap-y-2 text-lg md:text-base pt-4 ">
                            
                                <div>
                                    <dt class="leading-5">Toronto, Canada</dt>
                                    <dd class="text-sm md:text-[11.5px] pl-2">
                                        North York
                                    </dd>
                                    <dt class="leading-5">British Columbia, Canada</dt>
                                    <dd class="text-sm md:text-[11.5px] pl-2">
                                        3308 Evergreen Place, Burnaby
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="grow-0 text-center xl:text-left">
                    <div>
                        <header class="lg:text-lg xl:text-sm pt-12 md:pt-2 xl:pt-0">
                            Sign Up to Stay Updated <br>
                            with Our Latest Offers
                        </header>
                        <form action="{{ route('newsletter.store') }}" method="POST"
                              class="flex flex-col items-center py-5">
                            @csrf
                            <div class="relative w-full md:w-1/2 xl:w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 ">
                                    <img src="{{ Storage::url('/website/footer/user.svg') }}" alt="">
                                </div>
                                <input name="newsletter_email" type="email"
                                       class="w-full outline-0 block p-4 pl-10 text-sm text-white border border-white rounded-xl bg-footer placeholder:text-white"
                                       placeholder="E-mail">
                                <input type="text" name="name" class="hidden"/>
                                @error('newsletter_email')
                                <div class="alert alert-danger mb-0 p-1 w-75">{{ $message }}</div>
                                @enderror
                                <button type="submit"
                                        class="text-black w-1/3 md:w-1/4 xl:w-1/3 absolute right-0 bottom-0 top-0 bg-white font-medium rounded-lg text-sm px-4 py-2">
                                    Submit
                                </button>
                            </div>
                        </form>
                        <div class="pt-4 lg:pt-7 text-sm">
                            <div class="flex justify-center gap-3 pt-4">
                                <a href="https://play.google.com/store/apps/details?id=com.student.landa_trip&pcampaignid=web_share">
                                    <img src="{{ Storage::url("/website/footer/googlePlay.svg") }}" alt="">
                                </a>
                                <!--<a href="#">-->
                                <!--    <img src="{{ Storage::url("/website/footer/appleStore.svg") }}" alt="">-->
                                <!--</a>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-7">
                <hr class="border border-white ">
                <div class="flex flex-col justify-center lg:flex-row lg:justify-between w-full text-Privacy pt-7">
                    <div class="flex grow flex-col md:flex-row md:justify-between lg:gap-16">
                        <p class="py-2">© 2023 land trip inc. All rights reserved</p>
                    </div>
                    <div class="flex grow-0 justify-center gap-5 md:py-0 lg:gap-5 px-3">
                        <a href = "https://landatrip.ca/privacy-policy">Privacy Policy</a>
                        <p>Terms & Condition</p>
                    </div>
                    <div class="flex grow-0 flex-row justify-center gap-4 pt-5 lg:pt-0">

                        <a href="https://web.whatsapp.com/send?phone=+989131193442">
                            <img src="{{ Storage::url("/website/footer/whatsapp.svg") }}" alt="" class="w-7">
                        </a>
                        <a href="https://www.instagram.com/landatrip/?utm_source=ig_web_button_share_sheet&igshid=OGQ5ZDc2ODk2ZA==">
                            <img src="{{ Storage::url("/website/footer/instagram.svg") }}" alt="" class="w-7">
                        </a>
                        <a href="https://www.facebook.com/profile.php?id=100090941792487&mibextid=LQQJ4d">
                            <img src="{{ Storage::url("/website/footer/facebook.svg") }}" alt="" class="w-7">
                        </a>
                        <a href="https://www.linkedin.com/company/landatrip/">
                            <img src="{{ Storage::url("/website/footer/link.svg") }}" alt="" class="w-7">
                        </a>
                        <a href="https://youtube.com/landatrip">
                            <img src="{{ Storage::url("/website/footer/youtube.svg") }}" alt="" class="w-7">
                        </a>
                        <a href="https://twitter.com/landaholding">
                            <img src="{{ Storage::url("/website/footer/Vector.svg") }}" alt="" class="w-7">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>
