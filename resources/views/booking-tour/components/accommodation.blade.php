<div class="mt-10 ps-6">
    <h2 class="text-2xl">{{ __('accommodation') }}</h2>
    <div class="font-normal text-lg	mt-4 flex md:flex-row flex-col">
        <button class="bg-white hover:shadow-xl focus:shadow-xl px-4 py-3.5 flex flex-row rounded-xl ease-out duration-300 mx-4 md:my-0 my-2" role="tab" data-tabs-target="#airplane" id="airplane_tab">
            <img class="w-7 me-2" src="{{ Storage::url('/website/tours/hotel.svg') }}">
            <h3 class="">{{__('Hotel')}}</h3>
        </button>

        <button class="bg-white hover:shadow-xl focus:shadow-xl px-4 py-3.5 flex flex-row rounded-xl ease-out duration-300 mx-4 md:my-0 my-2" role="tab" id="bus_tab" data-tabs-target="#bus">
            <img class="w-7 me-2" src="{{ Storage::url('/website/tours/motel.svg') }}">
            <h3 class="">{{__('Motel')}}</h3>
        </button>

        <button class="bg-white hover:shadow-xl focus:shadow-xl px-4 py-3.5 flex flex-row rounded-xl ease-out duration-300 mx-4 md:my-0 my-2" role="tab" id="ship_tab" data-tabs-target="#ship">
            <img class="w-7 me-2" src="{{ Storage::url('/website/tours/tree.svg') }}">
            <h3 class="">{{__('Ecology')}}</h3>
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
            <div class="flex md:flex-row flex-col gap-3 rounded-xl border-b px-4 py-3.5 text-center justify-between">
                <div class="flex flex-col items-center">
                    <img class="w-20 m-2" src="{{ Storage::url('/website/tours/ocean.jpg') }}">
                    <h3 class="text-lg text-center">
                        Asgar
                    </h3>
                </div>
                <div class="flex flex-col ">
                    <h2 class="text-xl">
                        Classic room(7.4 point)
                    </h2>
                    <div class="flex flex-row my-4">
                        <span class="bg-[red] px-6 rounded-full text-center text-white">
                            {{__('Recomended')}}
                        </span>
                    </div>
                    <div class="flex flex-row lg:gap-7">
                        <p>
                            0.8 Km from Class
                        </p>
                        <p>
                            start from $100
                        </p>
                    </div>
                    <div class="flex flex-row lg:gap-7">
                        <p>
                            Breakfast included
                        </p>
                        <p>
                            1 night & 2 days
                        </p>
                    </div>
                    <div class="flex flex-row lg:gap-7">
                        <p>
                            Pay at the property
                        </p>
                        <p>
                            Free cancelation
                        </p>
                    </div>

                </div>

                <div class="flex justify-center items-center mx-4 self-start">
                    <a class="text-lightBlue underline ">Show on map</a>
                </div>

                <div class="flex flex-col self-center">
                    <button class="px-2 py-1.5 bg-primary text-white rounded-xl">
                        See availability
                    </button>
                </div>

            </div>
            <div class="flex md:flex-row flex-col gap-3 rounded-xl border-b px-4 py-3.5 text-center justify-between">
                <div class="flex flex-col items-center">
                    <img class="w-20 m-2" src="{{ Storage::url('/website/tours/ocean.jpg') }}">
                    <h3 class="text-lg text-center">
                        Asgar
                    </h3>
                </div>
                <div class="flex flex-col ">
                    <h2 class="text-xl">
                        Classic room(7.4 point)
                    </h2>
                    <div class="flex flex-row my-4">
                        <span class="bg-[red] px-6 rounded-full text-center text-white">
                            {{__('Recomended')}}
                        </span>
                    </div>
                    <div class="flex flex-row lg:gap-7">
                        <p>
                            0.8 Km from Class
                        </p>
                        <p>
                            start from $100
                        </p>
                    </div>
                    <div class="flex flex-row lg:gap-7">
                        <p>
                            Breakfast included
                        </p>
                        <p>
                            1 night & 2 days
                        </p>
                    </div>
                    <div class="flex flex-row lg:gap-7">
                        <p>
                            Pay at the property
                        </p>
                        <p>
                            Free cancelation
                        </p>
                    </div>

                </div>

                <div class="flex justify-center items-center mx-4 self-start">
                    <a class="text-lightBlue underline ">Show on map</a>
                </div>

                <div class="flex flex-col self-center">
                    <button class="px-2 py-1.5 bg-primary text-white rounded-xl">
                        See availability
                    </button>
                </div>

            </div>
            <div class="flex md:flex-row flex-col gap-3 rounded-xl border-b px-4 py-3.5 text-center justify-between">
                <div class="flex flex-col items-center">
                    <img class="w-20 m-2" src="{{ Storage::url('/website/tours/ocean.jpg') }}">
                    <h3 class="text-lg text-center">
                        Asgar
                    </h3>
                </div>
                <div class="flex flex-col ">
                    <h2 class="text-xl">
                        Classic room(7.4 point)
                    </h2>
                    <div class="flex flex-row my-4">
                        <span class="bg-[red] px-6 rounded-full text-center text-white">
                            {{__('Recomended')}}
                        </span>
                    </div>
                    <div class="flex flex-row lg:gap-7">
                        <p>
                            0.8 Km from Class
                        </p>
                        <p>
                            start from $100
                        </p>
                    </div>
                    <div class="flex flex-row lg:gap-7">
                        <p>
                            Breakfast included
                        </p>
                        <p>
                            1 night & 2 days
                        </p>
                    </div>
                    <div class="flex flex-row lg:gap-7">
                        <p>
                            Pay at the property
                        </p>
                        <p>
                            Free cancelation
                        </p>
                    </div>

                </div>

                <div class="flex justify-center items-center mx-4 self-start">
                    <a class="text-lightBlue underline ">Show on map</a>
                </div>

                <div class="flex flex-col self-center">
                    <button class="px-2 py-1.5 bg-primary text-white rounded-xl">
                        See availability
                    </button>
                </div>

            </div>
            <div class="flex md:flex-row flex-col gap-3 rounded-xl border-b px-4 py-3.5 text-center justify-between">
                <div class="flex flex-col items-center">
                    <img class="w-20 m-2" src="{{ Storage::url('/website/tours/ocean.jpg') }}">
                    <h3 class="text-lg text-center">
                        Asgar
                    </h3>
                </div>
                <div class="flex flex-col ">
                    <h2 class="text-xl">
                        Classic room(7.4 point)
                    </h2>
                    <div class="flex flex-row my-4">
                        <span class="bg-[red] px-6 rounded-full text-center text-white">
                            {{__('Recomended')}}
                        </span>
                    </div>
                    <div class="flex flex-row lg:gap-7">
                        <p>
                            0.8 Km from Class
                        </p>
                        <p>
                            start from $100
                        </p>
                    </div>
                    <div class="flex flex-row lg:gap-7">
                        <p>
                            Breakfast included
                        </p>
                        <p>
                            1 night & 2 days
                        </p>
                    </div>
                    <div class="flex flex-row lg:gap-7">
                        <p>
                            Pay at the property
                        </p>
                        <p>
                            Free cancelation
                        </p>
                    </div>

                </div>

                <div class="flex justify-center items-center mx-4 self-start">
                    <a class="text-lightBlue underline ">Show on map</a>
                </div>

                <div class="flex flex-col self-center">
                    <button class="px-2 py-1.5 bg-primary text-white rounded-xl">
                        See availability
                    </button>
                </div>

            </div>
        </div>

    </form>
</div>
</div>
</div>

</div>
</div>
</div>

<script>
    const numberElement = document.getElementById("number");
    const decrementButton = document.getElementById("decrement");
    const incrementButton = document.getElementById("increment");

    let currentNumber = 1;

    // Function to update the displayed number
    function updateNumber() {
        numberElement.value = currentNumber;
    }

    // Event listener for the decrement button
    decrementButton.addEventListener("click", () => {
        if (currentNumber > 1) {
            currentNumber--;
            updateNumber();
        }
    });

    // Event listener for the increment button
    incrementButton.addEventListener("click", () => {
        currentNumber++;
        updateNumber();
    });

    // Initial update
    updateNumber();
</script>
