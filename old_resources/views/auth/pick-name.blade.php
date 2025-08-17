{{--@extends('layout.layout')--}}

{{--@section("title", "Login Page")--}}

{{--@section('content')--}}
{{--    <div class="relative lg:m-5">--}}
{{--        <div class="absolute -z-10 h-full w-full lg:max-w-full p-5 lg:rounded-2xl bg-cover bg-center" style="background-image: url({{ Storage::url('/website/auth/login.png') }})  "></div>--}}

{{--        <header class="max-h-full overflow-hidden ">--}}
{{--            <div class="container mx-auto my-16 pt-10">--}}
{{--                <div class="grid grid-cols-5 w-full lg:w-100 mx-auto relative rounded-2xl overflow-hidden justify-start mt-20 lg:px-0 md:px-14">--}}
{{--                    <div class="flex flex-col self-center w-full xl:col-span-2 lg:col-span-3 col-span-5 ">--}}
{{--                        <div--}}
{{--                            class="shadow-inner shadow-white/40 bg-white/30 backdrop-opacity-95 backdrop-blur flex flex-col justify-around py-20 md:px-10 px-4 rounded-2xl border border-white ">--}}
{{--                            <h2 class="font-bold lg:text-3xl md:text-3xl text-2xl text-black mb-4 text-center">Welcome to Landa--}}
{{--                                Trip</h2>--}}
{{--                            <h3 class="text-black my-4 text-center">{{ auth()->user()->email }}</h3>--}}
{{--                            <div class="w-full bg-black h-px mb-8"></div>--}}
{{--                            <form class="grow-1 flex flex-col justify-center" action="{{ route('pick-name.store') }}" method="POST">--}}
{{--                                @csrf--}}
{{--                                <div class="my-2">--}}
{{--                                    <input--}}
{{--                                        class="text-black w-full py-3 px-4 rounded-2xl placeholder-darkGray border border-darkGray outline-0 bg-transparent @error('email') is-invalid @else @enderror"--}}
{{--                                        type="text" name="fname" id="fname" placeholder="Enter Your Name"--}}
{{--                                        value="{{ old("fname") }}"/>--}}
{{--                                    @error('fname')--}}
{{--                                    <div class="bg-error mb-0 p-2 w-full mb-2 ps-2 py-2 rounded-full mb-4">{{ $message }}</div>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                                <div class="my-2">--}}
{{--                                    <input--}}
{{--                                        class="text-black w-full py-3 px-4 rounded-2xl placeholder-darkGray border border-darkGray outline-0 bg-transparent @error('password') is-invalid @else   @enderror"--}}
{{--                                        type="text" name="lname" id="lname" placeholder="Enter Your Family Name"/>--}}
{{--                                    @error('lname')--}}
{{--                                    <div class="bg-error mb-0 p-2 w-full mb-2 ps-2 py-2 rounded-full mb-4">{{ $message }}</div>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                                <div class="bg-primary w-75 mx-auto my-2" style="height: 50px;"></div>--}}
{{--                                <input type="hidden" name="recaptcha" id="recaptcha">--}}
{{--                                <div class="w-full mx-auto flex justify-center ">--}}
{{--                                    <button type="submit"--}}
{{--                                            class="text-white bg-black px-10 py-4 rounded-2xl flex flex-row ">--}}
{{--                                        {{ __('next') }}--}}
{{--                                        <img src="{{ Storage::url('/website/auth/arrow-right.svg') }}">--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="hidden lg:flex p-0 flex flex-row justify-end"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </header>--}}
{{--    </div>--}}


{{--    <style>--}}
{{--        .fa-google {--}}
{{--            background: conic-gradient(from -45deg, #ea4335 110deg, #4285f4 90deg 180deg, #34a853 180deg 270deg, #fbbc05 270deg) 73% 55%/150% 150% no-repeat;--}}
{{--            -webkit-background-clip: text;--}}
{{--            color: transparent;--}}
{{--            -webkit-text-fill-color: transparent;--}}
{{--        }--}}
{{--    </style>--}}

{{--    <script>--}}
{{--        window.addEventListener('load', function () {--}}

{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}


{{--@extends('layout.layout')--}}

{{--@section("title", "Register Page")--}}

{{--@section('content')--}}
{{--    <div class="container-fluid position-relative m-0 p-0 overflow-hidden">--}}
{{--        <img class="position-absolute top-0 start-0 z-index-n-100" src="{{ asset('/website/register/orange-shape.svg') }}">--}}
{{--        <img class="position-absolute bottom-0 end-0 z-index-n-100" src="{{ asset('/website/register/pearl-blue-shape.svg') }}">--}}

{{--        <div class="container my-16 p-0 ">--}}
{{--            <div class="row mx-auto rounded-4 overflow-hidden d-flex flex-row justify-content-center w-95 bg-white shadow">--}}
{{--                <div class="col-24 col-lg-12 ps-6 pe-4 py-3 d-flex flex-column">--}}
{{--                        <h1 class="h2 pt-4 fw-bold mb-6 text-center text-green">{{ __('pages/auth-lang.Register Now') }}</h1>--}}
{{--                    @if ($errors->any())--}}
{{--                        @foreach ($errors->all() as $error)--}}
{{--                            <div>{{$error}}</div>--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
{{--                        <form class="flex-grow-1 px-2" method="POST" action="{{ route("update-registered-by-provider") }}">--}}
{{--                            @csrf--}}
{{--                            <div class="row gy-4 mb-4">--}}
{{--                                <div class="col-24 col-lg-12">--}}
{{--                                    <label class="fs-2 ms-1 mb-1" for="fname">{{ __('pages/auth-lang.First Name') }}<span class="text-orange ms-1">*</span></label>--}}
{{--                                    <input class="w-100 mb-2 rounded-pill px-3 py-2 rounded-2 form-control @error('fname') is-invalid @else border-0 bg-light-gray border-gray @enderror" type="text" name="fname" value="{{ old('fname') ? old('fname') : $user->fname }}" />--}}
{{--                                    @error('fname')--}}
{{--                                    <div class="alert alert-danger mb-0 p-1 w-100 mt-2 ps-2 py-1">{{ $message }}</div>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                                <div class="col-24 col-lg-12">--}}
{{--                                    <label class="fs-2 ms-1 mb-1" for="lname">{{ __('pages/auth-lang.Last Name') }}<span class="text-orange ms-1">*</span></label>--}}
{{--                                    <input class="w-100 mb-2 rounded-pill px-3 py-2 rounded-2 form-control @error('lname') is-invalid @else border-0 bg-light-gray border-gray @enderror" type="text" name="lname" value="{{ old('lname') ? old('lname') : $user->lname }}" />--}}
{{--                                    @error('lname')--}}
{{--                                    <div class="alert alert-danger mb-0 p-1 w-100 mt-2 ps-2 py-1">{{ $message }}</div>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="row gy-3 mb-5 justify-content-center">--}}
{{--                                <div class="col-24 col-lg-12 d-flex flex-column h-100">--}}
{{--                                    <label class="fs-2 ms-1 mb-1 h-100">--}}
{{--                                        <input class="d-none card-input-element" type="radio" name="role" id="user" value="user" @if(!in_array(request()->get('role'), ["teacher", "agent"])) checked @endif/>--}}
{{--                                        <div class="card card-input bg-light-gray border-0 h-100">--}}
{{--                                            <div class="card-body d-flex flex-column justify-content-around">--}}
{{--                                                <h5 class="card-title"><i class="text-green fs-4 fa-solid fa-graduation-cap me-3"></i> Student</h5>--}}
{{--                                                <p class="card-text">I’m a student, which want to participate in the tour courses and Learn many new things.</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-24 col-lg-12 d-flex flex-column h-100">--}}
{{--                                    <label class="fs-2 ms-1 mb-1 h-100">--}}
{{--                                        <input class="d-none card-input-element" type="radio" name="role" id="teacher" value="teacher" @if(request()->get('role') === "teacher") checked @endif/>--}}
{{--                                        <div class="card card-input bg-light-gray border-0 h-100">--}}
{{--                                            <div class="card-body d-flex flex-column justify-content-around">--}}
{{--                                                <h5 class="card-title"><i class="text-green fs-4 fa-solid fa-chalkboard-user me-3"></i> Teacher/Institute</h5>--}}
{{--                                                <p class="card-text">I’m a teacher or institute which can create, teach and operate educational courses.</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <div class="col-24 col-lg-12 d-flex flex-column h-100">--}}
{{--                                    <label class="fs-2 ms-1 mb-1 h-100">--}}
{{--                                        <input class="d-none card-input-element" type="radio" name="role" id="agent" value="agent" @if(request()->get('role') === "agent") checked @endif/>--}}
{{--                                        <div class="card card-input bg-light-gray border-0 h-100">--}}
{{--                                            <div class="card-body d-flex flex-column justify-content-around">--}}
{{--                                                <h5 class="card-title"><i class="text-green fs-4 fa-solid fa-plane-departure me-3"></i> Travel Agency</h5>--}}
{{--                                                <p class="card-text">I’m a travel agency that offers amazing tour handlings for fantastic places in my region.</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            @error('role')--}}
{{--                                <div class="alert alert-danger mb-0 p-1 w-100 mt-2 ps-2 py-1">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                            <input type="text" class="d-none" name="name">--}}
{{--							<div class="w-90 w-md-60 mx-auto">--}}
{{--								<input type="submit" class="w-100 p-2 mt-5 mb-3 rounded-3 btn btn-orange fw-bold text-white" value="{{ __('pages/auth-lang.Register') }}">--}}
{{--							</div>--}}
{{--                        </form>--}}
{{--                </div>--}}
{{--                <div class="col-24 col-lg-12 d-none d-md-flex p-3 d-flex flex-row justify-content-end">--}}
{{--                    <img class="w-100" src="{{ asset('/website/register/landa-trip-registeration-image.png') }}">--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}

{{--    <style>--}}
{{--        .card-input-element:checked + .card-input {--}}
{{--            box-shadow: 0 0 2px 2px var(--bs-orange);--}}
{{--        }--}}
{{--    </style>--}}
{{--@endsection--}}


@extends('layout.layout')

@section("title", "Login Page")

@section('content')
    <div class="relative lg:m-5">
        <div class="absolute -z-10 h-full w-full lg:max-w-full p-5 lg:rounded-2xl bg-cover bg-center"
             style="background-image: url({{ Storage::url('/website/auth/register-by-provider.png') }})  "></div>
        <header class="max-h-full overflow-hidden ">
            <div class="container mx-auto my-16 pt-10">
                <div class="grid grid-cols-5 w-full lg:w-100 mx-auto relative rounded-2xl overflow-hidden justify-start mt-16 lg:px-0 md:px-14">
                    <div class="flex flex-col self-center w-full xl:col-span-2 lg:col-span-3 col-span-5 ">
                        <div
                                class="md:w-[560px] md:h-[670px]  bg-white/60 backdrop-opacity-95 backdrop-blur flex flex-col justify-around py-40 md:px-10 px-4 rounded-2xl border border-white ">
                            <h1 class="font-bold lg:text-4xl md:text-3xl text-2xl text-black mb-4 text-center">Welcome
                                to Landa Trip</h1>
                            <div class="w-full mt-4">
                                <h3 class="text-black my-4 text-center">{{ auth()->user()->email }}</h3>

                            </div>
                            <div class="w-full bg-black h-px"></div>
                            <form class="px-2" action="{{ route('pick-name.store') }}" method="POST">
                                @csrf
                                <div class="md:grid md:grid-cols-2 gap-4">
                                    <div class="lg:my-0.5 my-3">
                                        <input class="text-darkGray w-full py-3 px-4 rounded-2xl placeholder-darkGray border border-darkGray outline-0 bg-transparent  @error('fname') is-invalid  @else @enderror"
                                               type="text" name="fname"
                                               value="{{ old('fname') }}"
                                               placeholder="First Name"/>
                                        @error('fname')
                                        <div class="bg-error rounded-lg mb-0 p-2 w-full mt-2 ps-2  ">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="lg:my-0.5 my-3">
                                        <input class="text-darkGray w-full py-3 px-4 rounded-2xl placeholder-darkGray border border-darkGray outline-0 bg-transparent @error('lname') is-invalid @else  @enderror"
                                               type="text" name="lname"
                                               value="{{ old('lname') }}"
                                               placeholder="Last Name"/>
                                        @error('lname')
                                        <div class="bg-error rounded-lg mb-0 p-2 w-full mt-2 ps-2  ">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <button type="submit"
                                            class="text-white bg-black px-10 py-4 rounded-2xl flex flex-row mt-8">
                                        {{ __('Next') }}
                                        <img src="{{ Storage::url('/website/auth/arrow-right.svg') }}">
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="hidden lg:flex p-0 flex flex-row justify-end"></div>
                </div>
            </div>
        </header>
    </div>


    <style>
        .fa-google {
            background: conic-gradient(from -45deg, #ea4335 110deg, #4285f4 90deg 180deg, #34a853 180deg 270deg, #fbbc05 270deg) 73% 55%/150% 150% no-repeat;
            -webkit-background-clip: text;
            color: transparent;
            -webkit-text-fill-color: transparent;
        }
    </style>

    <script>
        window.addEventListener('load', function () {

        });
    </script>
@endsection
