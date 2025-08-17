@extends('layout.layout')

@section("title", "Login Page")

@section('content')
    <div class="relative lg:m-5">
        <div class="absolute -z-10 h-full w-full lg:max-w-full p-5 lg:rounded-2xl bg-cover bg-center" style="background-image: url({{ Storage::url('/website/auth/verify.png') }})  "></div>

        <header class="max-h-full overflow-hidden ">
            <div class="container mx-auto my-16 pt-10">
                <div class="grid grid-cols-5 w-full lg:w-100 mx-auto relative rounded-2xl overflow-hidden justify-start mt-16 lg:px-0 md:px-14">
                    <div class="flex flex-col self-center w-full xl:col-span-2 lg:col-span-3 col-span-5 ">
                        <div
                            class="shadow-inner shadow-white/40 bg-white/30 backdrop-opacity-95 backdrop-blur flex flex-col justify-around py-40 md:px-10 px-4 rounded-2xl border border-white ">
                            <h1 class="font-bold lg:text-4xl md:text-3xl text-2xl text-black mb-4 text-center">Verify your Email</h1>
                            <div class="w-full mt-4">
                                <p class="flex justify-center text-center text-lg">
                                    We have already sent you an email which contains a verification code. Check your inbox and enter the code here.
                                </p>
                            </div>
                            <div class="w-full bg-black h-px my-2"></div>
                            <form class="" action="{{ route('verify.store') }}" method="POST">
                                @csrf
                                <div class="relative my-12">
                                    <input class="text-darkGray w-full py-3 px-4 rounded-2xl placeholder-darkGray border border-darkGray outline-0 bg-transparent  @error('input-code') is-invalid  @else @enderror" type="text" name="input-code" id="input-code" placeholder="Enter Confirmation Code"/>
                                    <div class="md:absolute top-1 right-1 flex justify-center">
                                        <button class="text-black md:px-8 px-12 mt-5 md:mt-0 md:py-2 py-3 rounded-xl bg-lightBlue">Resend</button>
                                    </div>
                                </div>
                                @error('input-code')
                                <div class="bg-danger mb-0 p-1 w-100 mt-2 ps-2 py-1">{{ $message }}</div>
                                @enderror
                                <div class="w-full mx-auto flex justify-center ">
                                    <button type="submit"
                                            class="text-white bg-black px-10 py-4 rounded-2xl flex flex-row ">
                                        {{ __('Confirm ') }}
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
