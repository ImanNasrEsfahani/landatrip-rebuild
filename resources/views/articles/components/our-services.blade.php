<div class="container mx-auto pt-10 md:pt-12 lg:pt-14">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($articles as  $article)
            <div class="bg-primary rounded-lg text-white py-4 px-6 flex flex-row justify-between items-center">
                {{--                <i class="text-secondary fs-5 p-5 bg-white rounded-full fa-solid {{ $article->fontawesome }}"></i>--}}
                <div class="flex items-center">
                    <img class="text-secondary fs-5 p-5 bg-white rounded-full fa-solid"
                         src="{{Storage::url("/article/header/articleIcon.svg")}}">
                    <span class="text-lg align-self-center ml-4">{{ $article->title }}</span>
                </div>
                <span class="text-lg">{{ $article->articles->count() }}</span>
            </div>
        @empty
        @endforelse
    </div>
</div>
