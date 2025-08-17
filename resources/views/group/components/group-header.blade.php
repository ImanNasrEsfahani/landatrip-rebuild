<div class="d-flex flex-row">
    @if($group->thumbnailImage)
        <img class="h-100 mt-1 rounded-circle max-w-4rem" src="{{ asset('/groups/thumbnails/' . $group->thumbnailImage->url) }}" alt="{{ $group->thumbnailImage->alt }}">
    @else
        <img class="h-100 mt-1 rounded-circle max-w-4rem" src="{{ asset('/groups/thumbnails/default.png') }}" alt="group image">
    @endif
    <div class="ms-3 d-flex flex-column flex-grow-1 align-self-center">
        <h5 class="h6 mb-1">{{ $group->title }}</h5>
        <p class="text-dark-gray mb-0">{{ $group->users()->count() }} {{ __('pages/group.members') }}</p>
    </div>
</div>
<hr class="w-100 mt-2 mb-4 mx-auto border-dark-gray">
