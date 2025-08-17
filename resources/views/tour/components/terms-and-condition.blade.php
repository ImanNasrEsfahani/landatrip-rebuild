<div id="terms-and-conditions" class="mt-32">
    <h4 class="text-4xl text-center lg:text-left font-bold mb-10 ">{{ __('pages/tour-lang.Terms and Conditions') }}</h4>
    <div class="join join-vertical w-full">
        @forelse($tour->termAndCondition as $item)
            <div class="collapse collapse-arrow join-item border border-base-300">
                <input type="radio" name="my-accordion-4" checked="checked"/>
                <div class="collapse-title text-xl font-medium bg-primary text-white">
                    {{ $item->question }}
                </div>
                <div class="collapse-content bg-lightGreen text-black">
                    <p class="p-3">{{ $item->answer }}</p>
                </div>
            </div>
        @empty
            <p class="text-danger">{{ __('pages/tour-lang.No Terms and Conditions') }}</p>
        @endforelse
    </div>
</div>

