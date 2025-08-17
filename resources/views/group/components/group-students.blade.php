<div class="mt-4 w-100 bg-white shadow rounded-3">
    <div class="bg-white w-100 h-auto px-3 py-4 rounded-3">
        <h5 class="h5 ms-2 d-inline-block">{{ __('pages/group.Participants') }}</h5>
        <span class="fs-1 text-dark-gray">({{ $group->users()->count() }}{{ __('pages/group.members') }}</span>
        <div class="row mt-3 gy-3 justify-content-evenly">
            @forelse( $group->users()->get() as $student)
                <div class="col text-center">
                    <a class="text-decoration-none" href="{{ route('profile.show', $student) }}">
                        @if($student->profileImage)
                            <img class="max-h-5rem ms-2 me-4 rounded-4 mb-1"
                                 src="{{ asset('/users/profile/' . $student->profileImage?->url) }}"
                                 alt="{{ asset('/users/profile/' . $student->profileImage?->alt) }}">
                        @else
                            <img class="max-h-5rem ms-2 me-4 rounded-4 mb-1"
                                 src="{{ asset('/users/profile/') }}/{{ $student->sex === 2 ? "female.png" : "male.png" }}"
                                 alt="{{ $student->name }}">
                        @endif
                    </a>
                </div>
            @empty
            @endforelse
        </div>
    </div>
</div>
