<div class="d-flex flex-row p-0 m-0">
    @if($post->contentImage)
        <img class="w-100 h-auto" src="{{ asset('/communities/posts/' . $post->contentImage->url) }}" alt="{{ $post->contentImage->alt }}">
    @else
        <img class="w-100 h-auto" src="{{ asset('/communities/posts/default.png') }}" alt="">

    @endif
</div>
