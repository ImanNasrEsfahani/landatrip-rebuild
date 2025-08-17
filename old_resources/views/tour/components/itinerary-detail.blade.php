<div id="itinerary-details" class="mt-32">
    <h4 class="text-4xl text-center lg:text-left font-bold mb-10 ">{{ __('pages/tour-lang.Itinerary Detail') }}</h4>
    <div class="join join-vertical w-full">
        @forelse($tour->tourItineraries as $item)
            <div class="collapse collapse-arrow join-item border border-base-300">
                <input type="radio" name="my-accordion-3" checked="checked"/>
                <div class="collapse-title text-xl font-medium bg-primary text-white">
                    {{$item->title }}
                </div>
                <div class="collapse-content bg-lightGreen text-black">
                    <p class="p-3">{!! $item->description !!}</p>
                </div>
            </div>
        @empty
            <p class="text-danger">{{ __('pages/tour-lang.No Itinerary') }}</p>
        @endforelse
    </div>
</div>
