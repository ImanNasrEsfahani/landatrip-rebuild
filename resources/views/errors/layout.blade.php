<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', "Landa Trip error page")</title>
    </head>
    <body>
        @include('navbar.navbar')
        <div class="position-relative container-fluid p-0 m-0 overflow-hidden">
            <img class="d-none d-lg-block position-absolute top-n-20 start-n-20 z-index-n-200" src="{{ asset('/errors/orange-shape-1.svg') }}" alt="Landa Trip 404 error image">
            <img class="d-none d-lg-block position-absolute bottom-n-40 end-n-20 z-index-n-200" src="{{ asset('/errors/orange-shape-2.svg') }}" alt="Landa Trip 404 error image">
            <img class="d-none d-lg-block position-absolute top-70 start-20 z-index-n-200" src="{{ asset('/errors/orange-shape-3.svg') }}" alt="Landa Trip 404 error image">

            <div class="container mx-auto">
                <div class="bg-black bg-opacity-75 rounded-4 mt-12 mb-14">
                    <div class="row mx-auto px-0 mx-0">
                        <div class="col-23 col-lg-14 py-3 d-flex flex-column justify-content-between py-4">
                            <div class="w-100 text-center">
                                <h1 class="ms-0 ms-xl-4 display-1 text-white fw-bold my-0 border-1 border-bottom border-white">@yield('code')</h1>
                            </div>
                            <div>
                                <h4 class="h2 text-white ms-0 ms-lg-4 mb-4 text-center text-lg-start">@yield('title')</h4>
                                <p class="text-white ms-0 ms-lg-4 fs-4 lh-base my-4 mt-lg-0 mb-lg-2 text-center text-lg-start">@yield('message')</p>
                            </div>

                            <div class="w-100 d-flex flex-row justify-content-center justify-content-lg-end">
                                <a href="{{ route("home-page") }}" class="btn btn-orange text-white rounded-3 px-5 py-2 fs-4 me-0 me-lg-4 letter-space-9dpx"><i class="text-white fa-sharp fa-solid fa-share fa-flip-horizontal me-2"></i> Home</a>
                            </div>
                        </div>
                        <div class="col-23 col-lg-10 py-3 text-center text-lg-end pe-0 pe-lg-3">
                            <img class="w-100 h-auto w-xl-auto h-xl-100 rounded-3 max-h-lg-80vh" src="{{ asset('/errors/404.png') }}" alt="Landa Trip 404 error image" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('footer.footer')

        @viteReactRefresh
        @vite(['resources/scss.scss', 'resources/js.js'])
    </body>
</html>
