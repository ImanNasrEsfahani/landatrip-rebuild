<div>
    @includeIf('livewire.posts-page.components.nav-image')
    <div class="container max-w-[855px] mx-auto pt-5">
        @includeIf('livewire.profile.components.profile-details')
        <div class="mt-10">
            @forelse($user->userPosts as $post)
                @if($post->is_approved && !$post->is_drafted)
                    @livewire('single-post', ['post' => $post, 'user' => $user], key($post->id))
                @endif
            @empty
            @endforelse
        </div>
        @includeIf('livewire.profile.components.login-popup')

    </div>
</div>
