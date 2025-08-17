<div class="mt-32 w-full" id="highlight">
    <h3 class="text-center lg:text-left text-black mb-10 text-4xl font-bold">{{ __('pages/tour-lang.Highlights') }}</h3>
    <ul class="list-unstyled ml-4">
        @forelse($tour->tourHighlights as $highlight)
            <li class="flex mb-4 gap-x-3 items-center">
                <img src="{{Storage::url("/website/tours/tick-circle.svg")}}" />
                <span>{{ $highlight->title }}</span>
            </li>
        @empty
            <li class="d-flex mb-4">
                <i class="text-orange align-self-center fs-4 pe-2 bg-white rounded-circle fa-solid fa-circle-check"></i>
                <span class="text-danger">{{ __('pages/tour-lang.no Highlights') }}</span>
            </li>
        @endforelse
    </ul>
</div>
