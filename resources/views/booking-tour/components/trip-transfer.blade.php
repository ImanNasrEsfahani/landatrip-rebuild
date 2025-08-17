            <div class="mt-10 md:ps-6 px-4 md:px-0">
                <h2 class="md:text-2xl text-3xl md:mb-2 mb-4">{{ __('Trip transfer') }}</h2>
                <div class="font-normal text-lg	mt-4 flex md:flex-row flex-col ">
                    <button class="bg-white hover:shadow-xl focus:shadow-xl px-4 py-3.5 flex flex-row rounded-xl ease-out duration-300 mx-4 md:my-0 my-2" role="tab" data-tabs-target="#airplane" id="airplane_tab">
                        <img class="w-7 me-2" src="{{ Storage::url('/website/tours/airplane.svg') }}">
                        <h3 class="">Airplane</h3>
                    </button>

                    <button class="bg-white hover:shadow-xl focus:shadow-xl px-4 py-3.5 flex flex-row rounded-xl ease-out duration-300 mx-4 md:my-0 my-2" role="tab" id="bus_tab" data-tabs-target="#bus">
                        <img class="w-7 me-2" src="{{ Storage::url('/website/tours/bus.svg') }}">
                        <h3 class="">{{__('Bus')}}</h3>
                    </button>

                    <button class="bg-white hover:shadow-xl focus:shadow-xl px-4 py-3.5 flex flex-row rounded-xl ease-out duration-300 mx-4 md:my-0 my-2" role="tab" id="ship_tab" data-tabs-target="#ship">
                        <img class="w-7 me-2" src="{{ Storage::url('/website/tours/ship.svg') }}">
                        <h3 class="">Ship</h3>
                    </button>
                </div>
                <form class="mt-4">
                    <div class="card shadow-xl">
                        <div class="card-body py-6 flex md:flex-row flex-col gap-0">
                            <div class="md:border-e md:border-[#999] w-full px-2 md:py-2 py-4">
                                <select class="py-2 outline-0 px-1 w-full text-lg cursor-pointer appearance-auto bg-cover bg-center">
                                    <option disabled selected>origin</option>
                                    <option>Normal Apple</option>
                                    <option>Normal Orange</option>
                                    <option>Normal Tomato</option>
                                </select>
                            </div>

                            <div class="md:border-e md:border-[#999] w-full px-2 md:py-2 py-4">
                                <select class="py-2 outline-0 px-1 w-full text-lg cursor-pointer appearance-auto bg-cover bg-center	" style="background-image: url('{{Storage::url('/website/tours/arrow-down.svg') }}}}')">
                                    <option disabled selected>Start date</option>
                                    <option>Normal Apple</option>
                                    <option>Normal Orange</option>
                                    <option>Normal Tomato</option>
                                </select>
                            </div>
                            <div class="w-full px-2 md:py-2 py-4">
                                <select class="py-2 outline-0 px-1 w-full text-lg cursor-pointer appearance-auto bg-cover bg-center ">
                                    <option disabled selected>Return date</option>
                                    <option>Normal Apple</option>
                                    <option>Normal Orange</option>
                                    <option>Normal Tomato</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="card shadow-xl flex flex-col mt-8 md:h-96 h-[520px] overflow-y-scroll scroll-bar ">
                        <div class="flex md:flex-row flex-col gap-3 rounded-xl border-b px-4 py-3.5 justify-between">
                            <div class="flex flex-col justify-center items-center">
                                <img class="w-12 m-2 rounded-full" src="{{ Storage::url('/website/tours/profile.png') }}">
                                <h3 class="text-lg text-center">
                                    Qatar Airways
                                </h3>
                            </div>
                            <div class="flex flex-row">
                                <div class="flex flex-col justify-center">
                                    <span class="justify-center text-lg">05:10</span>
                                    <h3 class="text-sm">Tehran</h3>
                                </div>
                            </div>
                            <div class="flex flex-row ">
                                <div class="flex flex-col justify-center text-center items-center w-full">
                                    <span class="justify-center text-sm	">3:45</span>
                                    <img class="md:w-11/12	w-full" src="{{ Storage::url('/website/tours/plan.png') }}">
                                    <span class="justify-center text-sm	">Start from $500</span>
                                </div>
                            </div>
                            <div class="flex flex-row">
                                <div class="flex flex-col justify-center text-center">
                                    <span class="justify-center text-lg">05:10</span>
                                    <h3 class="text-sm text-center">Asgarabad</h3>
                                </div>
                            </div>

                            <div class="flex flex-col self-center">
                                <button class="px-8 py-1.5 bg-primary text-white rounded-xl">
                                    Select
                                </button>
                            </div>
                        </div>
                        <div class="flex md:flex-row flex-col gap-3 rounded-xl border-b px-4 py-3.5 justify-between">
                            <div class="flex flex-col justify-center items-center">
                                <img class="w-12 m-2 rounded-full" src="{{ Storage::url('/website/tours/profile.png') }}">
                                <h3 class="text-lg text-center">
                                    Qatar Airways
                                </h3>
                            </div>
                            <div class="flex flex-row">
                                <div class="flex flex-col justify-center">
                                    <span class="justify-center text-lg">05:10</span>
                                    <h3 class="text-sm">Tehran</h3>
                                </div>
                            </div>
                            <div class="flex flex-row ">
                                <div class="flex flex-col justify-center text-center items-center w-full">
                                    <span class="justify-center text-sm	">3:45</span>
                                    <img class="md:w-11/12	w-full" src="{{ Storage::url('/website/tours/plan.png') }}">
                                    <span class="justify-center text-sm	">Start from $500</span>
                                </div>
                            </div>
                            <div class="flex flex-row">
                                <div class="flex flex-col justify-center text-center">
                                    <span class="justify-center text-lg">05:10</span>
                                    <h3 class="text-sm text-center">Asgarabad</h3>
                                </div>
                            </div>

                            <div class="flex flex-col self-center">
                                <button class="px-8 py-1.5 bg-primary text-white rounded-xl">
                                    Select
                                </button>
                            </div>
                        </div>
                        <div class="flex md:flex-row flex-col gap-3 rounded-xl border-b px-4 py-3.5 justify-between">
                            <div class="flex flex-col justify-center items-center">
                                <img class="w-12 m-2 rounded-full" src="{{ Storage::url('/website/tours/profile.png') }}">
                                <h3 class="text-lg text-center">
                                    Qatar Airways
                                </h3>
                            </div>
                            <div class="flex flex-row">
                                <div class="flex flex-col justify-center">
                                    <span class="justify-center text-lg">05:10</span>
                                    <h3 class="text-sm">Tehran</h3>
                                </div>
                            </div>
                            <div class="flex flex-row ">
                                <div class="flex flex-col justify-center text-center items-center w-full">
                                    <span class="justify-center text-sm	">3:45</span>
                                    <img class="md:w-11/12	w-full" src="{{ Storage::url('/website/tours/plan.png') }}">
                                    <span class="justify-center text-sm	">Start from $500</span>
                                </div>
                            </div>
                            <div class="flex flex-row">
                                <div class="flex flex-col justify-center text-center">
                                    <span class="justify-center text-lg">05:10</span>
                                    <h3 class="text-sm text-center">Asgarabad</h3>
                                </div>
                            </div>

                            <div class="flex flex-col self-center">
                                <button class="px-8 py-1.5 bg-primary text-white rounded-xl">
                                    Select
                                </button>
                            </div>
                        </div>
                        <div class="flex md:flex-row flex-col gap-3 rounded-xl border-b px-4 py-3.5 justify-between">
                            <div class="flex flex-col justify-center items-center">
                                <img class="w-12 m-2 rounded-full" src="{{ Storage::url('/website/tours/profile.png') }}">
                                <h3 class="text-lg text-center">
                                    Qatar Airways
                                </h3>
                            </div>
                            <div class="flex flex-row">
                                <div class="flex flex-col justify-center">
                                    <span class="justify-center text-lg">05:10</span>
                                    <h3 class="text-sm">Tehran</h3>
                                </div>
                            </div>
                            <div class="flex flex-row ">
                                <div class="flex flex-col justify-center text-center items-center w-full">
                                    <span class="justify-center text-sm	">3:45</span>
                                    <img class="md:w-11/12	w-full" src="{{ Storage::url('/website/tours/plan.png') }}">
                                    <span class="justify-center text-sm	">Start from $500</span>
                                </div>
                            </div>
                            <div class="flex flex-row">
                                <div class="flex flex-col justify-center text-center">
                                    <span class="justify-center text-lg">05:10</span>
                                    <h3 class="text-sm text-center">Asgarabad</h3>
                                </div>
                            </div>

                            <div class="flex flex-col self-center">
                                <button class="px-8 py-1.5 bg-primary text-white rounded-xl">
                                    Select
                                </button>
                            </div>
                        </div>
                        <div class="flex md:flex-row flex-col gap-3 rounded-xl border-b px-4 py-3.5 justify-between">
                            <div class="flex flex-col justify-center items-center">
                                <img class="w-12 m-2 rounded-full" src="{{ Storage::url('/website/tours/profile.png') }}">
                                <h3 class="text-lg text-center">
                                    Qatar Airways
                                </h3>
                            </div>
                            <div class="flex flex-row">
                                <div class="flex flex-col justify-center">
                                    <span class="justify-center text-lg">05:10</span>
                                    <h3 class="text-sm">Tehran</h3>
                                </div>
                            </div>
                            <div class="flex flex-row ">
                                <div class="flex flex-col justify-center text-center items-center w-full">
                                    <span class="justify-center text-sm	">3:45</span>
                                    <img class="md:w-11/12	w-full" src="{{ Storage::url('/website/tours/plan.png') }}">
                                    <span class="justify-center text-sm	">Start from $500</span>
                                </div>
                            </div>
                            <div class="flex flex-row">
                                <div class="flex flex-col justify-center text-center">
                                    <span class="justify-center text-lg">05:10</span>
                                    <h3 class="text-sm text-center">Asgarabad</h3>
                                </div>
                            </div>

                            <div class="flex flex-col self-center">
                                <button class="px-8 py-1.5 bg-primary text-white rounded-xl">
                                    Select
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
