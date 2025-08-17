{{--@extends('layout.layout')--}}

{{--@section("title", "Reset Password")--}}
{{--@section('content')--}}
{{--    <div class="container-fluid position-relative m-0 p-0 min-vh-80 d-flex flex-column justify-content-center overflow-hidden">--}}
{{--        <img class="position-absolute top-0 start-0 z-index-n-100" src="{{ asset('/website/login/orange-ellipse.svg') }}">--}}
{{--        <img class="position-absolute bottom-0 end-0 z-index-n-100" src="{{ asset('/website/login/blue-ellipse.svg') }}">--}}
{{--        @if(show_status())--}}
{{--            @dd(show_status())--}}
{{--        @endif--}}
{{--        <div class="container my-5 p-0">--}}
{{--            <div class="row w-95 w-lg-100 min-vh-60 mx-auto position-relative shadow rounded-3 overflow-hidden d-flex flex-row justify-content-center">--}}
{{--                <div class="col-23 col-md-12 px-0 bg-white d-flex flex-column justify-content-around py-8 px-5">--}}
{{--                    <h1 class="fw-bold text-green mb-3 text-center fs-8">Enter Your <span class="text-orange fs-9">Email Address</span></h1>--}}
{{--                    <form action="{{ route('password.update') }}" method="post">--}}
{{--                        @csrf--}}
{{--                        <input type="hidden" name="email" value="{{ $request->email }}" >--}}
{{--                        <input type="hidden" name="token" value="{{ $request->token }}">--}}
{{--                        <div class="flex-grow-0 mb-5 RobotoSlab-font-family">--}}
{{--                            <h5 class="text-secondary text-center fs-5 fw-normal mt-4 mb-1 mx-3 lh-base">{{ __('To continue using Landa Trip, please enter your Email address:') }}</h5><br>--}}
{{--                            <h5 class="fst-italic text-center text-dark fs-5 fw-normal mt-4 mb-1 mx-3" ></h5>--}}
{{--                            <label class="fs-2 ms-1 mb-1" for="password">New Password<span class="text-orange ms-1">*</span></label>--}}
{{--                            <input class="w-100 mb-2 rounded-pill px-3 py-2 rounded-2 form-control @error('password') is-invalid @else border-0 bg-light-gray border-gray @enderror" type="password" name="password" value="{{ old('password') }}" />--}}
{{--                            @error('password')--}}
{{--                            <div class="alert alert-danger mb-0 p-1 w-100 mt-2 ps-2 py-1">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                            <label class="fs-2 ms-1 mb-1" for="password_confirmation">Confirm Password<span class="text-orange ms-1">*</span></label>--}}
{{--                            <input class="w-100 mb-2 rounded-pill px-3 py-2 rounded-2 form-control @error('password_confirmation') is-invalid @else border-0 bg-light-gray border-gray @enderror" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" />--}}
{{--                            @error('password_confirmation')--}}
{{--                            <div class="alert alert-danger mb-0 p-1 w-100 mt-2 ps-2 py-1">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                        <div class="row justify-content-between gy-4">--}}
{{--                            <div class="col-24 col-md-12">--}}
{{--                                <input type="submit" value="Submit" class="btn btn-outline-orange rounded-pill px-6 py-3 w-100">--}}
{{--                            </div>--}}
{{--                            <div class="col-24 col-md-12">--}}
{{--                                <a href="{{ route('home-page') }}" class="text-white btn btn-orange rounded-pill px-6 py-3 w-100">{{ __('Return Home') }}</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--                <div class="col-0 col-md-12 px-0">--}}
{{--                    <img id="img-verify" src="{{ asset('/website/verification/verification-certificate-bg-image.png') }}">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <style>--}}
{{--        .fa-google {--}}
{{--            background: conic-gradient(from -45deg, #ea4335 110deg, #4285f4 90deg 180deg, #34a853 180deg 270deg, #fbbc05 270deg) 73% 55%/150% 150% no-repeat;--}}
{{--            -webkit-background-clip: text;--}}
{{--            color: transparent;--}}
{{--            -webkit-text-fill-color: transparent;--}}
{{--        }--}}
{{--        @media screen and (max-width: 690px) {--}}
{{--            #img-verify {--}}
{{--                display: none !important;--}}
{{--            }--}}
{{--        }--}}
{{--    </style>--}}
{{--@endsection--}}


{{--@extends('layout.layout')--}}

{{--@section("title", "Reset Password")--}}
{{--@section('content')--}}
{{--    <div class="min-h-screen flex justify-center items-center overflow-hidden">--}}
{{--        <img class="absolute top-0 left-0 z-[-100]" src="{{ asset('/website/login/orange-ellipse.svg') }}">--}}
{{--        <img class="absolute bottom-0 right-0 z-[-100]" src="{{ asset('/website/login/blue-ellipse.svg') }}">--}}
{{--        <div class="container mx-auto py-5">--}}
{{--            <div class="bg-white shadow rounded-lg lg:flex">--}}
{{--                <div class="lg:w-1/2 p-8">--}}
{{--                    <h1 class="text-3xl font-bold text-green mb-3 text-center">--}}
{{--                        Enter Your <span class="text-orange text-4xl">Email Address</span>--}}
{{--                    </h1>--}}

{{--                    <form action="{{ route('password.update') }}" method="post">--}}
{{--                        @csrf--}}

{{--                        <div class="mb-5">--}}
{{--                            <h5 class="text-secondary text-center text-lg font-normal mt-4 mb-1">--}}
{{--                                {{ __('To continue using Landa Trip, please enter your Email address:') }}--}}
{{--                            </h5>--}}

{{--                            <label for="password" class="text-2xl font-semibold mt-4 mb-1">New Password<span--}}
{{--                                        class="text-orange">*</span></label>--}}
{{--                            <input class="w-full mb-2 rounded-lg px-3 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror"--}}
{{--                                   type="password" name="password" value="{{ old('password') }}"/>--}}
{{--                            @error('password')--}}
{{--                            <div class="text-red-600 mt-2">{{ $message }}</div>--}}
{{--                            @enderror--}}

{{--                            <label for="password_confirmation" class="text-2xl font-semibold mt-4 mb-1">Confirm Password<span--}}
{{--                                        class="text-orange">*</span></label>--}}
{{--                            <input class="w-full mb-2 rounded-lg px-3 py-2 border @error('password_confirmation') border-red-500 @else border-gray-300 @enderror"--}}
{{--                                   type="password" name="password_confirmation"--}}
{{--                                   value="{{ old('password_confirmation') }}"/>--}}
{{--                            @error('password_confirmation')--}}
{{--                            <div class="text-red-600 mt-2">{{ $message }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}

{{--                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">--}}
{{--                            <div class="lg:col-span-1">--}}
{{--                                <input type="submit" value="Submit" class="btn btn-outline-orange w-full"/>--}}
{{--                            </div>--}}
{{--                            <div class="lg:col-span-1">--}}
{{--                                <a href="{{ route('home-page') }}"--}}
{{--                                   class="btn btn-orange w-full">{{ __('Return Home') }}</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}

{{--                <div class="hidden lg:flex lg:w-1/2">--}}
{{--                    <img id="img-verify"--}}
{{--                         src="{{ asset('/website/verification/verification-certificate-bg-image.png') }}">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    </div>--}}
{{--    <style>--}}
{{--        .fa-google {--}}
{{--            background: conic-gradient(from -45deg, #ea4335 110deg, #4285f4 90deg 180deg, #34a853 180deg 270deg, #fbbc05 270deg) 73% 55%/150% 150% no-repeat;--}}
{{--            -webkit-background-clip: text;--}}
{{--            color: transparent;--}}
{{--            -webkit-text-fill-color: transparent;--}}
{{--        }--}}

{{--        @media screen and (max-width: 690px) {--}}
{{--            #img-verify {--}}
{{--                display: none !important;--}}
{{--            }--}}
{{--        }--}}
{{--    </style>--}}





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
                            <div class="md:w-[560px] md:h-[670px]  bg-white/60 backdrop-opacity-95 backdrop-blur flex flex-col justify-around py-40 md:px-10 px-4 rounded-2xl border border-white ">
                                <h1 class="font-bold lg:text-4xl md:text-3xl text-2xl text-black mb-4 text-center">Reset your Password</h1>
                                <div class="w-full mt-4">
                                    <h3 class="text-black my-4 text-center">{{ $request->input('email') }}</h3>
                                    @foreach ($errors->all() as $error)
                                        <div class="text-red-600">{{ $error }}</div>
                                    @endforeach

                                </div>
                                <div class="w-full bg-black h-px"></div>
                                @if(Session::get('successful'))
                                    <!-- <div class="text-green-600 text-xl">{{Session::get('successful')}}</div> -->
                                    <div class="alert bg-transparent border-transparent">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        <span>{{Session::get('successful')}}</span>
                                    </div>
                                    @else
                                    <form class="px-2" action="{{ route('password.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="email" value="{{ $request->email }}" >
                                        <input type="hidden" name="token" value="{{ $request->token }}">
                                        <div >
                                            <div class="my-3">
                                                <input class="text-darkGray w-full py-3 px-4 rounded-2xl placeholder-darkGray border border-darkGray outline-0 bg-transparent  @error('password') is-invalid  @else @enderror"
                                                       type="text" name="password"
                                                       value="{{ old('password') }}"
                                                       placeholder="Password"/>
                                                @error('password')
                                                <div class="bg-error rounded-lg mb-0 p-2 w-full mt-2 ps-2  ">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="my-5">
                                                <input class="text-darkGray w-full py-3 px-4 rounded-2xl placeholder-darkGray border border-darkGray outline-0 bg-transparent @error('password_confirmation') is-invalid @else  @enderror"
                                                       type="text" name="password_confirmation"
                                                       value="{{ old('password_confirmation') }}"
                                                       placeholder="Password confirmation"/>
                                                @error('password_confirmation')
                                                <div class="bg-error rounded-lg mb-0 p-2 w-full mt-2 ps-2  ">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="flex justify-center">
                                            <button type="submit"
                                                    class="text-white bg-black px-10 py-4 rounded-2xl flex flex-row mt-8">
                                                {{ __('Return Home') }}
                                                <img src="{{ Storage::url('/website/auth/arrow-right.svg') }}">
                                            </button>
                                        </div>
                                    </form>
                                @endif
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
