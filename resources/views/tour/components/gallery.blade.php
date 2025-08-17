<div id="gallery" class="mt-32">
    <h4 class="text-4xl text-center lg:text-left font-bold mb-10 ">{{ __('pages/tour-lang.Gallery') }}</h4>
    <section class="splide gallery-splide" aria-label="Splide Basic HTML Example">
        <div class="splide__track">
            <ul class="splide__list">
                @forelse($tour->gallery()->get() as $galleryObj)
                    <li class="splide__slide">
                        <div class="pswp-gallery pswp-gallery--single-column h-full" id="gallery--getting-started">
                            <a class="position-relative" href="{{ Storage::url("/courses/gallery/" . $galleryObj->url) }}"
                               data-pswp-width="1500"
                               data-pswp-height="1000"
                               data-cropped="true"
                              >
                                <img class="rounded-xl h-80 md:h-60 w-full object-cover"
                                     src="{{ Storage::url("/courses/gallery/" . $galleryObj->url) }}"
                                     alt="{{ $galleryObj->alt }}"/>
                            </a>
                        </div>
                    </li>
                @empty
                @endforelse

            </ul>
        </div>
    </section>
    <dialog id="modal" class="modal">
        <div class="modal-box">
            <div class="modal-action">
                <form method="dialog">
                    <img src="">
                    <!-- if there is a button in form, it will close the modal -->
                    <button class="btn">Close</button>
                </form>
            </div>
        </div>
    </dialog>
</div>

