@if($user->userBadgeLevels->first())
<div class="bg-white shadow-xl rounded-2xl p-8">
    <h2 class="text-2xl font-semibold">
        Trip Collective Badge Collection
    </h2>
    <div class="flex flex-row justify-between flex-wrap gap-5 mt-10">
        @forelse($user->userBadgeLevels as $userBadge)
            <img class="w-24" alt="badge" src="{{ Storage::url('/badges/'.$userBadge->badgeLevel->image) }}">
        @empty
        @endforelse
    </div>
</div>
@endif
