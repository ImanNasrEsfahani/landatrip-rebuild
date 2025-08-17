@extends('layout.layout')

@section("title", "Login Page")

@section('content')
    <div class="relative lg:m-5">
        <div class="absolute -z-10 h-full w-full lg:max-w-full p-5 lg:rounded-2xl bg-cover bg-center" style="background-image: url({{ Storage::url('/website/auth/choose-role.png') }})  "></div>

        <header class="max-h-full overflow-hidden ">
            <div class="container mx-auto my-16 pt-10">
                <div class="grid grid-cols-5 w-full lg:w-100 mx-auto relative rounded-2xl overflow-hidden justify-start mt-20 lg:px-0 md:px-14">
                    <div class="flex flex-col self-center w-full xl:col-span-2 lg:col-span-3 md:col-span-5 col-span-5 ">
                        <div
                            class="shadow-inner shadow-white/40 bg-white/60 backdrop-opacity-95 backdrop-blur flex flex-col justify-around py-16 md:px-10 px-4 rounded-2xl border border-white md:w-[560px] md:h-[670px]">
                            <h1 class="font-bold mt-16 lg:text-4xl md:text-3xl text-3xl text-black mb-4 text-center">Choose role</h1>
                            <div class="w-full mt-4">
                                <p class="flex justify-center text-center text-lg">
                                    Your registration process has just completed successfully. now, choose your role!
                                </p>
                            </div>
                            <div class="w-full bg-black h-px"></div>
                            <form action="{{ route('choose-role.store') }}" method="POST">
                                @csrf
                                <div class="md:grid md:grid-cols-2 grid-cols-1 gap-4">
                                    <div class="flex flex-col h-full w-full my-2 ">
                                        <input class="hidden card-input-element peer" type="radio" name="role" id="user" value="user" @if(!in_array(request()->get('role'), ["teacher", "agent"]) || is_null(old("role"))) checked @endif/>
                                        <label class="h-full peer-checked:border border-lightBlue peer-checked:bg-white/80 rounded-2xl cursor-pointer" for="user">
                                            <div class="card card-input border-0 h-full">
                                                <div class="card-body flex flex-col justify-around p-3">
                                                    <h5 class="card-title text-center mx-auto">Trainee</h5>
                                                    <p class="card-text text-center">I am a trainee and eager to learn while traveling.</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="flex flex-col h-full w-full my-2">
                                        <input class="hidden card-input-element peer" type="radio" name="role" id="teacher" value="teacher" @if(request()->get('role') === "teacher" || old("role") === "teacher") checked @endif/>
                                        <label class="h-full peer-checked:border border-lightBlue peer-checked:bg-white/80 rounded-2xl cursor-pointer" for="teacher">
                                            <div class="card card-input border-0 h-full">
                                                <div class="card-body flex flex-col justify-around p-3">
                                                    <h5 class="card-title text-center mx-auto"> Trainer</h5>
                                                    <p class="card-text text-center">I am a trainer and tend to cooperate with you.</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <button type="submit" class="text-white bg-black px-10 py-4 rounded-2xl flex flex-row mt-14">
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
