<div class="my-3 w-100 position-relative mt-3 rounded-4 overflow-hidden brochure-bg-header">
    @if($tour->brochureImage)
{{--        @dd($tour->brochureImage->url)--}}
        <img class="w-100 h-auto" src="{{ Storage::url("/courses/brochure/thumbnail/" . $tour->brochureImage->url  ) }}" alt="">
    @else
        <img class="w-100 h-auto" src="{{ Storage::url("/courses/brochure/thumbnail/default.png") }}" alt="">
    @endif

    <h3 class="position-absolute top-10 start-50 translate-middle-x w-100 text-center text-white fw-bold ">Tour Brochure</h3>
    <a class="position-absolute bottom-20 start-50 translate-middle-x w-75 fs-3 text-white border-white fw-bolder text-center btn rounded-pill px-2 py-1" href="">Download the tour brochure</a>
</div>

<style>
    .brochure-bg-header:before {
        content: "";
        display: inline-block;
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-image: linear-gradient( rgba(0, 0, 0, 0.0) 0%, rgba(0, 0, 0, 1.0) 100% );
        border-radius: 0.75rem !important
    }
</style>
