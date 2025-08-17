<div class="bg-white shadow w-100 h-auto p-3 rounded-3">
    <div class="w-75 mx-auto text-center">
        @if($group->thumbnailImage)
            <img class="w-100 max-w-10rem text-center rounded-circle" src="{{ asset('/groups/thumbnails/' . $group->thumbnailImage->url) }}" alt="{{ $group->thumbnailImage->alt }}">
        @else
            <img class="w-100 max-w-10rem text-center rounded-circle" src="{{ asset('/groups/thumbnails/default.png') }}" alt="group image">
        @endif
    </div>
    <div class="w-100 mt-3">
        <p class="text-center mb-1"><b>{{ $group->title }}</b></p>
    </div>
{{--    <div class="w-75 mx-auto mt-3">--}}
{{--        <i class="text-orange fa-solid fa-barcode"></i>--}}
{{--        <span class="ms-2">20220301</span>--}}
{{--    </div>--}}
    <div class="w-75 mx-auto mt-3">
        <i class="text-orange fa-solid fa-clock"></i>
        <span class="ms-2">{{ Carbon\Carbon::create($group->start_date)->isoFormat('MMM Do gg') }}</span>
    </div>
    <div class="w-75 mx-auto mt-2">
        @switch($group->status)
        @case('Completed')
            <i class="text-orange fa-solid fa-battery-full"></i>
            <span class="ms-2">{{ __('pages/group.Completed') }}</span>
        @break
        @case('cancelled')
            <i class="fa-solid fa-battery-empty"></i>
            <span class="ms-2">{{ __('pages/group.Cancelled') }}</span>
        @break
        @case('In Progress')
            <i class="fa-solid fa-battery-half"></i>
            <span class="ms-2">{{ __('pages/group.In Progress') }}</span>
        @break
        @default
        @endswitch
    </div>
</div>
