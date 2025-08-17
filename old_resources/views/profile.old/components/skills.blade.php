<div class="container mx-auto py-5 my-10 w-full bg-white shadow-xl rounded-2xl">
    <p class="text-primary font-bold text-xl">Skills</p>
    <div class="flex flex-wrap gap-3 my-5">
        @foreach($user->skills as $skill)
            <p class="bg-gray text-mediumGray text-base font-bold rounded-lg px-5 py-2">
                # {{$skill}}
            </p>
        @endforeach
    </div>
</div>