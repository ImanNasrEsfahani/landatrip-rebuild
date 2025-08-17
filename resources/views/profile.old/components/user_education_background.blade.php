<div class="d-block w-100">
    <h6 class="text-black">{{ __('pages/profile.education') }}</h6>
    <ul class="text-dark-gray fs-2">
    @forelse($user->userEducations()->get() as $item)
        <li class="mb-2">{{ $item->level }} - {{ $item->title }} at {{ $item->university }} from  {{ $item->from }}-{{ $item->to }}</li>
    @empty
    @endForelse
    </ul>
</div>

<div class="d-block w-100">
    <h6 class="text-black">{{ __('pages/profile.Skills') }}</h6>
    <p class="text-dark-gray fs-2">{{ __('pages/profile.Skills sub') }}</p>
</div>
