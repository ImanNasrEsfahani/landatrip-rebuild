<div class="mt-4 bg-white shadow w-100 h-auto px-2 py-4 rounded-3">
    <div class="w-100">
        <h6 class="h5 ms-3 mb-0">{{ __('pages/group.Tutors') }}</h6>
    </div>
    <div class="row mt-4">
        @forelse($group->groupTutors()->get() as $tutor)
            <div class="col d-flex flex-column w-fit align-items-center text-center">
                <a class="text-decoration-none" href="{{ route("profile.show", $tutor) }}">
                    @if($tutor->user->profileImage)
                        <img class="max-h-6rem ms-2 me-4 rounded-4 mb-2"
                             src="{{ asset('/users/profile/' . $tutor->user->profileImage?->url) }}"
                             alt="{{ asset('/users/profile/' . $tutor->user->profileImage?->alt) }}">
                    @else
                        <img class="max-h-6rem ms-2 me-4 rounded-4 mb-2"
                             src="{{ asset('/users/profile/') }}/{{ $tutor->user->sex === 2 ? "female.png" : "male.png" }}"
                             alt="{{ $tutor->user->name }}">
                    @endif
                </a>
                <a class="text-decoration-none lh-sm text-dark" href="{{ route("api.public.profile.show", $tutor) }}">
                    <span class="fs-1">{{ $tutor->user->fname }} {{ $tutor->user->lname }}</span>
                </a>
            </div>
        @empty
        @endforelse
    </div>
</div>
