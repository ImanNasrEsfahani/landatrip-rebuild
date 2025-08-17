<h4 class="text-center lg:text-left text-black mb-10 text-4xl font-bold">{{ __('pages/tour-lang.Excludes') }}</h4>
<ul class="list-unstyled ml-3">
    @forelse($tour->tourExcludes as $item)
        <li class="flex mb-4 gap-x-3 items-center">
            <img src="{{Storage::url("website/tours/minus-cirlce.svg")}}">
            <span>{{ $item->title }}</span>
        </li>
    @empty
        <li class="flex mb-2">
            <img src="{{Storage::url("website/tours/minus-cirlce.svg")}}">
            <span>{{ __('pages/tour-lang.No excludes') }}</span>
        </li>
    @endforelse
</ul>
