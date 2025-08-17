<div class="container mx-auto mt-32">
    <div class="flex flex-col-reverse lg:flex-row justify-between gap-x-16">
        <div class="basis-3/5">
            <form class="bg-white shadow rounded-xl px-8 pt-6 pb-8 mb-4" action="{{url()->current() }}"}}">
                <div class="flex flex-row justify-between gap-5">
                    <input type="text" placeholder="Your Name *" class="input input-bordered w-full border-[#646665] border-1 rounded-2xl" />
                    <input type="email" placeholder="Your Email *" class="input input-bordered w-full border-[#646665] border-1 rounded-2xl" />
                </div>
                <div class="mt-14">
                    <h2 class="text-xl font-semibold my-8">
                        Select a topic
                    </h2>
                    <ul class="flex flex-wrap  gap-5 items-center w-full text-sm font-medium text-gray-900 bg-white ">
                        <li class=" ">
                            <input type="radio" id="1" name="hosting" value="" class="hidden peer" >
                            <label for="1" class="inline-flex items-center justify-between  text-black bg-white border border-mediumGray rounded-full cursor-pointer    peer-checked:border-primary peer-checked:text-primary ">
                                <div class="block">
                                    <div class="w-full py-4 px-5 text-sm font-medium">Adding or removing users</div>
                                </div>
                            </label>
                        </li>
                        <li class="">
                            <input type="radio" id="2" name="hosting" value="" class="hidden peer" >
                            <label for="2" class="inline-flex items-center justify-between  text-black bg-white border border-mediumGray rounded-full cursor-pointer    peer-checked:border-primary peer-checked:text-primary ">
                                <div class="block">
                                    <div class="w-full py-4 px-5 text-sm font-medium">Billing and plans</div>
                                </div>
                            </label>
                        </li>
                        <li class=" ">
                            <input type="radio" id="3" name="hosting" value="" class="hidden peer" >
                            <label for="3" class="inline-flex items-center justify-between  text-black bg-white border border-mediumGray rounded-full cursor-pointer    peer-checked:border-primary peer-checked:text-primary ">
                                <div class="block">
                                    <div class="w-full py-4 px-5 text-sm font-medium">Signing in</div>
                                </div>
                            </label>
                        </li>
                        <li class=" ">
                            <input type="radio" id="4" name="hosting" value="" class="hidden peer" >
                            <label for="4" class="inline-flex items-center justify-between  text-black bg-white border border-mediumGray rounded-full cursor-pointer    peer-checked:border-primary peer-checked:text-primary ">
                                <div class="block">
                                    <div class="w-full py-4 px-5 text-sm font-medium">Connection Trouble</div>
                                </div>
                            </label>
                        </li>
                        <li class=" ">
                            <input type="radio" id="5" name="hosting" value="" class="hidden peer" >
                            <label for="5" class="inline-flex items-center justify-between  text-black bg-white border border-mediumGray rounded-full cursor-pointer    peer-checked:border-primary peer-checked:text-primary ">
                                <div class="block">
                                    <div class="w-full py-4 px-5 text-sm font-medium">Notifications</div>
                                </div>
                            </label>
                        </li>
                        <li class=" ">
                            <input type="radio" id="6" name="hosting" value="" class="hidden peer" >
                            <label for="6" class="inline-flex items-center justify-between  text-black bg-white border border-mediumGray rounded-full cursor-pointer    peer-checked:border-primary peer-checked:text-primary ">
                                <div class="block">
                                    <div class="w-full py-4 px-5 text-sm font-medium">New design feedback</div>
                                </div>
                            </label>
                        </li>
                        <li class=" ">
                            <input type="radio" id="7" name="hosting" value="" class="hidden peer" >
                            <label for="7" class="inline-flex items-center justify-between  text-black bg-white border border-mediumGray rounded-full cursor-pointer    peer-checked:border-primary peer-checked:text-primary ">
                                <div class="block">
                                    <div class="w-full py-4 px-5 text-sm font-medium">Managing Channels</div>
                                </div>
                            </label>
                        </li>
                        <li class=" ">
                            <input type="radio" id="8" name="hosting" value="" class="hidden peer" >
                            <label for="8" class="inline-flex items-center justify-between  text-black bg-white border border-mediumGray rounded-full cursor-pointer    peer-checked:border-primary peer-checked:text-primary ">
                                <div class="block">
                                    <div class="w-full py-4 px-5 text-sm font-medium">Trial of a paid plan</div>
                                </div>
                            </label>
                        </li>
                    </ul>
                </div>


                <div class="mt-7">
                    <label class="block text-gray-700 text-2xl mb-2" for="problem">
                        Or tell us what you need help with?
                    </label>
                    <textarea id="textarea" maxlength="256" class="textarea mt-4 textarea-bordered w-full border-[#646665] border-1 rounded-2xl placeholder-[#646665]::placeholder text-lg" placeholder="Text Area Initial" rows="8"></textarea>
                    <div class="w-full text-right">
                        <label for="textarea" class="text-darkGray mt-1">
                            Maximum 256 Character
                        </label>
                    </div>

                </div>
                <div class="flex items-end justify-end mt-6">
                    <button class="bg-black mt-5 text-white py-3 px-4 rounded-xl focus:outline-none focus:shadow-outline bg-darkBlue"
                            type="submit">
                        Send
                    </button>
                </div>
            </form>
        </div>
        <div>
            <img class="mx-auto" src={{Storage::url("website/contact-us/review.png")}}>
        </div>
    </div>
</div>

