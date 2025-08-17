<div id="includes">
    <h4 class="text-center lg:text-left text-black mb-10 text-4xl font-bold">{{ __('pages/tour-lang.Includes') }}</h4>
    <ul class="list-unstyled ml-3">
        @forelse($tour->tourIncludes as $item)
            <li class="flex mb-4 gap-x-3 items-center">
               <img src="{{Storage::url("website/tours/add-circle.svg")}}">
                <span>{{ $item->title }}</span>
            </li>
        @empty
            <li class="d-flex mb-2">
                <img src="{{Storage::url("website/tours/add-circle.svg")}}">
                <span>{{ __('pages/tour-lang.No includes') }}</span>
            </li>
        @endforelse
    </ul>
</div>
