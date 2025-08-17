<div class="w-100 p-4 pe-2 fs-3 py-4 mt-5 shadow rounded-2 d-flex flex-column">
    <div class="w-100 text-center justify-content-center border-2 border-orange border rounded-4 p-4 mb-4 position-relative">
        <img class="max-w-8rem rounded-pill mb-2" src="{{ "/users/profile/". $tour->user->profileImage->url }}" alt="">
        <h4>{{ $tour->user->fname }} {{ $tour->user->lname }}</h4>
        <h5>{{ $tour->user->title }}</h5>
        @for($star = 0; $star < 5; $star++)
            @if($star < 4)
                <i class="fa-solid fa-star d-inline-block text-orange"></i>
                    @else
                <i class="fa-solid fa-star d-inline-block text-secondary"></i>
            @endif
        @endfor
        <a class="stretched-link" href="{{ route("profile", $tour->user->slug) }}"></a>
    </div>
    <div class="w-100 mb-2 d-flex flex-row mb-3">
        <span class="text-orange fa-stack align-self-center me-2">
          <i class="fa-thin fa-circle fa-stack-2x"></i>
          <i class="fa fa-clock fa-stack-1x"></i>
        </span>
        <div class="d-flex flex-column">
            <h3 class="d-inline fs-3 fw-bold ms-1 mb-1">{{ __('pages/tour-lang.Duration') }}</h3>
            <p class="text-dark-gray fs-2 ms-2 mb-0">{{ $tour->days }} days, {{ $tour->nights }} nights</p>
        </div>
    </div>
    <div class="w-100 mb-2 d-flex flex-row mb-3">
        <span class="text-orange fa-stack align-self-center me-2">
          <i class="fa-thin fa-circle fa-stack-2x"></i>
          <i class="fa-solid fa-location-dot fa-stack-1x"></i>
        </span>
        <div class="d-flex flex-column">
            <h3 class="d-inline fs-3 fw-bold ms-1 mb-1">{{ __('pages/tour-lang.Destination') }}</h3>
            <p class="text-dark-gray fs-2 ms-2 mb-0">{{ $tour->city->name }}, {{ $tour->city->country->name }}</p>
        </div>
    </div>
    <div class="w-100 mb-2 d-flex flex-row mb-3">
        <span class="text-orange fa-stack align-self-center me-2">
          <i class="fa-thin fa-circle fa-stack-2x"></i>
          <i class="fa-solid fa-gear fa-stack-1x"></i>
        </span>
        <div class="d-flex flex-column">
            <h3 class="d-inline fs-3 fw-bold ms-1 mb-1">{{ __('pages/tour-lang.Skill') }}</h3>
            <p class="text-dark-gray fs-2 ms-2 mb-0">{{ $tour->skills }}</p>
        </div>
    </div>
    <div class="w-100 mb-2 d-flex flex-row mb-3">
        <span class="text-orange fa-stack align-self-center me-2">
          <i class="fa-thin fa-circle fa-stack-2x"></i>
          <i class="fa-solid fa-users-medical fa-stack-1x"></i>
        </span>
        <div class="d-flex flex-column">
            <h3 class="d-inline fs-3 fw-bold ms-1 mb-1">{{ __('pages/tour-lang.Group Size') }}</h3>
            <p class="text-dark-gray fs-2 ms-2 mb-0">{{ $lastGroup->min_capacity }} - {{ $lastGroup->max_capacity }} people</p>
        </div>
    </div>
    <div class="w-100 mb-2 d-flex flex-row mb-3">
        <span class="text-orange fa-stack align-self-center me-2">
          <i class="fa-thin fa-circle fa-stack-2x"></i>
          <i class="fa-solid fa-hotel fa-stack-1x"></i>
        </span>
        <div class="d-flex flex-column">
            <h3 class="d-inline fs-3 fw-bold ms-1 mb-1">{{ __('pages/tour-lang.Accommodation') }}</h3>
            <p class="text-dark-gray fs-2 ms-2 mb-0">{{ $lastGroup->accommodation }}</p>
        </div>
    </div>
    <div class="w-100 mb-2 d-flex flex-row mb-3">
        <span class="text-orange fa-stack align-self-center me-2">
          <i class="fa-thin fa-circle fa-stack-2x"></i>
          <i class="fa-solid fa-pizza-slice fa-stack-1x"></i>
        </span>
        <div class="d-flex flex-column">
            <h3 class="d-inline fs-3 fw-bold ms-1 mb-1">{{ __('pages/tour-lang.Meals') }}</h3>
            <p class="text-dark-gray fs-2 ms-2 mb-0">{{ $lastGroup->meals }}4 Breakfast, 2 lunch, and 1 dinner</p>
        </div>
    </div>
    <div class="w-100 mb-2 d-flex flex-row mb-3">
        <span class="text-orange fa-stack align-self-center me-2">
          <i class="fa-thin fa-circle fa-stack-2x"></i>
          <i class="fa-solid fa-plane-up fa-stack-1x"></i>
        </span>
        <div class="d-flex flex-column">
            <h3 class="d-inline fs-3 fw-bold ms-1 mb-1">{{ __('pages/tour-lang.Transport') }}</h3>
            <p class="text-dark-gray fs-2 ms-2 mb-0">{{ $lastGroup->transport }}</p>
        </div>
    </div>
    <div class="w-100 mb-2 d-flex flex-row mb-3">
        <span class="text-orange fa-stack align-self-center me-2">
          <i class="fa-thin fa-circle fa-stack-2x"></i>
          <i class="fa-solid fa-badge-check fa-stack-1x"></i>
        </span>
        <div class="d-flex flex-column">
            <h3 class="d-inline fs-3 fw-bold ms-1 mb-1">{{ __('pages/tour-lang.Certificates') }}</h3>
            <p class="text-dark-gray fs-2 ms-2 mb-0">{!! $tour->certificates !!}</p>
        </div>
    </div>
    <div class="w-100 mb-2 d-flex flex-row mb-3">
        <span class="text-orange fa-stack align-self-center me-2">
          <i class="fa-thin fa-circle fa-stack-2x"></i>
          <i class="fa-solid fa-award fa-stack-1x"></i>
        </span>
        <div class="d-flex flex-column">
            <h3 class="d-inline fs-3 fw-bold ms-1 mb-1">{{ __('pages/tour-lang.Reviews') }}</h3>
            <p class="text-dark-gray fs-2 ms-2 mb-0">4.1/5 ({{ $tour->tourComments()->count() }} comments)</p>
        </div>
    </div>
</div>
