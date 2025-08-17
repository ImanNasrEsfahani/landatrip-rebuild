            <div class="mt-10 md:ps-6 md:px-0 px-4">
                <h2 class="md:text-2xl  text-3xl md:mb-2 mb-4">{{ __('Travelers') }}</h2>
            <div class="card shadow-xl rounded-xl flex mt-2 ">
                <div class="card-body py-6 flex md:flex-row flex-col justify-between leading-tight text-lg">
                    <h4 class="self-center">Number of travelers?</h4>
                        <div class="self-center flex justify-center">
                            <button class="p-0" id="decrement">
                                <img src="{{ Storage::url('/website/tours/minus-cirlce.svg') }}">
                            </button>
                            <form class="">
                                <input type="text" class="w-5 mx-8  outline-0" id="number" readonly>
                            </form>

                            <button class="p-0" id="increment">
                                <img src="{{ Storage::url('/website/tours/add-circle.svg') }}">
                            </button>
                        </div>


                </div>
            </div>
            </div>

