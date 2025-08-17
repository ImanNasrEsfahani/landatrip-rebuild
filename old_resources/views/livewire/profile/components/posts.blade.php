    <div class="bg-white shadow-xl rounded-2xl p-8">
        <div class="flex flex-row justify-between">
            <h2 class="text-2xl font-semibold self-center">
                Posts
            </h2>
            <a href="{{ route('posts-page', $user->slug) }}" wire:navigate class="btn  p-3 rounded-2xl bg-black hover:bg-darkGray text-white normal-case">
                Show More
            </a>
        </div>
        <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1  mt-5 gap-2">
            @forelse($user->userPosts as $post)
                @if($post->is_approved && !$post->is_drafted)
                    <div class="relative flex justify-end">
                        <a href="{{ route('posts-page', $user->slug).'#'.$post->id }}" wire:navigate class="after:absolute after:inset-0">
                            @if(str_contains($post->images[0]->file_type, 'video'))
                                <img class="absolute w-9 end-2 top-2" src="{{ Storage::url('/posts/posts-icon/video.svg') }}" />
                                <video class="aspect-square object-cover rounded w-full" autoplay muted loop>
                                    <source src="{{ Storage::url('posts/'.$post->images[0]->url) }}" type="video/mp4">
                                </video>
                            @else
                                <img class="absolute w-9 end-2 top-2" src="{{ Storage::url('/posts/posts-icon/'.($post->images->count() === 1 ? "gallery.svg":"multi-media.svg")) }}" />
                                <img class="aspect-square object-cover rounded w-full" alt="name of the post" src="{{ Storage::url('/posts/'.$post->images->first()->url) }}">
                            @endif
                        </a>
                    </div>
                @endif
            @empty
                <div class="text-center col-span-4">
                    <img class="w-12 mx-auto" src="{{ Storage::url('/posts/posts-icon/camera.png') }}" alt="No Posts yet">
                    <h3 class="font-medium">No Posts yet</h3>
                </div>
            @endforelse
        </div>
</div>
