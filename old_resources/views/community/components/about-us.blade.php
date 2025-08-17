<div class="w-100 py-2 px-3 mb-2 shadow bg-white rounded-3 text-start">
    <p class="mb-0"><b>{{ __('pages/community.About') }}</b></p>
    <p class="mb-0 fs-3">{{ $community->about_us }}</p>
    <p class="mb-0 text-dark">{{ __('pages/community.Read more') }}</p>
    <p class="mb-0"><b>Followers </b>{{ $community->users()->count() }}</p>
</div>
