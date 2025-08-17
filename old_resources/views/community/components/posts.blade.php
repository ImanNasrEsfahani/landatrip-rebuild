<div class="w-100 bg-white shadow rounded-4 overflow-hidden h-auto mb-4">
    <div class="d-flex flex-column w-100 pt-1">
        @includeIf('community.components.post_header')
        @includeIf('community.components.post_content')
        <div class="w-95 mx-auto mt-3">
            @includeIf('community.components.post_summary')
            @includeIf('community.components.comments-and-replies')
            @includeIf('community.components.new-comment-for-post')
        </div>
    </div>

</div>
