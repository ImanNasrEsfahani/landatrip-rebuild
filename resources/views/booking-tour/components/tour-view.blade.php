
<div class="mt-10 md:ps-6 md:px-0 px-4">
    <h2 class="md:text-2xl text-3xl md:mb-2 mb-4">{{ __('TOUR OVERVIEW') }}</h2>
    <div class="card shadow-xl rounded-xl flex">
        <div class="card-body flex md:flex-row flex-col leading-tight text-lg">
            <div class="md:w-1/2 w-full py-4 md:py-0 flex flex-row md:border-0 border-b border-[#999] ">
                <img class="me-2 w-7" src="{{ Storage::url('/website/tours/calendar.svg') }}">
                <p class="flex justify-center self-center">
                    Saturday, September 30th, 2023
                    To Sunday, October 8th, 2023
                </p>
            </div>
            <div class="md:w-1/2 w-full  flex flex-col md:border-[#999] md:border-s">
                <ul class="list-none md:ps-5">
                    <li class="flex flex-row my-3">
                        <img class="me-2 w-7" src="{{ Storage::url('/website/tours/profile-2user.svg') }}">
                        10 Spaces left
                    </li>
                    <li class="flex flex-row my-3">
                        <img class="me-2 w-7" src="{{ Storage::url('/website/tours/clock.svg') }}">
                        We keep your reservation for 10 minutes
                    </li>
                    <li class="flex flex-row my-3">
                        <img class="me-2 w-7" src="{{ Storage::url('/website/tours/thunder.svg') }}">
                        Your reservation will be secured.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
