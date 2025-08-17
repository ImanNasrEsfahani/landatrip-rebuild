{{--<div class="container-fluid position-relative p-0 m-0 overflow-hidden d-flex flex-column justify-content-center">--}}
{{--    <picture>--}}
{{--        <source media="(min-width: 768px)" data-srcset="{{ asset("/website/blog/header/article-header.webp") }}">--}}
{{--        <source data-srcset="{{ asset("/website/blog/header/article-header-mobile.webp") }}">--}}
{{--        <img class="w-auto h-100 w-lg-100 h-lg-auto z-index-n-100 lazyload" data-src="{{ asset("/website/blog/header/article-header.png") }}" alt="Landa-Trip-Blog-Image">--}}
{{--    </picture>--}}
{{--    <div class="container position-absolute bottom-0 bottom-lg-10 start-50 translate-middle h-50 d-flex flex-column justify-content-between">--}}
{{--        <h1 class="text-white text-center fs-15 h2 mb-4">{{ __('pages/articles.articles') }}</h1>--}}
{{--    </div>--}}
{{--</div>--}}
<header class="lg:m-5">
    <div class="relative h-[130vh]  md:h-[95vh]">
        <div class="absolute -z-10 h-full w-full lg:max-w-full p-5 lg:rounded-2xl bg-cover bg-center bg-no-repeat"
             style="background-image: url({{ Storage::url("/website/blog/header/article-header-mobile.webp") }}) "></div>
        <div class=" absolute top-[85%] left-[50%] w-[80%] md:w-[60%] h-full  overflow-x-hidden"
             style="transform: translate(-50%, -50%)">
            <h1 class="custom-stroke-text text-4xl lg:text-5xl xl:text-h1 text-center leading-tight">Articles</h1>
        </div>
    </div>
</header>






{{-- <div class="w-full bg-cover	bg-center"
    style="background-image: url(' {{  Storage::url('/website/homepage/back.jpg') }} ')">
<div class="container  mx-auto lg:p-16 lg:p-16 p-2 text-white lg:text-4xl md:text-3xl text-2xl font-bold roboto">
  <div class="py-8">
    <p class="mt-16">
      Education and Trip beyond
      </br>
      the borders with the best </p>
    <p class="lg:text-lg md:text-lg text-xl mt-6 pt-0 m-0" style="margin-top: 0px">
      -Travel & Learning </p>
  </div>
  <form>
    <div class="w-full rounded-xl md:p-4 p-0 md:mt-20 mt-12 font-light text-xl " style="background-color:#ffffffba">
      <div class="">
        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1">
          <div class=" px-9 self-center my-2 md:my-0">
            <select class="w-full select bg-transparent block text-black leading-tight focus:outline-none " id="grid-state">
              <option>New Mexico</option>
              <option>Missouri</option>
              <option>Texas</option>
            </select>
          </div>
          <div class="px-9 border-x-2 self-center my-2 md:my-0" style="border-color: #ffb964">
            <select class=" w-full block select bg-transparent text-black leading-tight focus:outline-none " id="grid-state">
              <option>New Mexico</option>
              <option>Missouri</option>
              <option>Texas</option>
            </select>
          </div>
          <div class="flex px-9 self-center my-4 md:my-0">
            <button class="bg-secondary w-full py-1.5 px-20 rounded-xl" type="submit">
              Search
            </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
</div> --}}
