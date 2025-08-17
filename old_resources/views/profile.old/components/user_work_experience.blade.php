<div class="d-block w-100 mt-4">
    <h6 class="text-black">{{ __('pages/profile.Companies') }}</h6>
    @forelse($user->userCompanies()->get() as $item)
    <div class="d-block ms-2">
        <h6 class="text-black">{{ $item->company_name }} - from {{ $item->from }} to {{ $item->to }}</h6>
        <p class="text-dark-gray fs-2"><b>{{ __('pages/profile.Position') }}:</b> {{ $item->position }}</p>
    </div>
{{--     <div class="d-block ms-2"> --}}
{{--         <h6 class="text-black">{{ __('pages/profile.Melale – 2019 – 2022') }}</h6> --}}
{{--         <p class="text-dark-gray fs-2">{{ __('pages/profile.Position: Web developer') }}</p> --}}
{{--     </div> --}}
    @empty
    @endForelse
</div>
