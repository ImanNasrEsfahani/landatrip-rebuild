@extends('layout.layout')

@section("title", "Login Page")

@section('content')
    <div class="relative lg:m-5">
        <div class="absolute -z-10 h-full w-full lg:max-w-full p-5 lg:rounded-2xl bg-cover bg-center" style="background-image: url({{ Storage::url('/website/auth/choose-role.png') }})  "></div>

        <header class="max-h-full overflow-hidden ">
            <div class="container mx-auto my-16 pt-10">
                <div class="grid grid-cols-5 w-full lg:w-100 mx-auto relative rounded-2xl overflow-hidden justify-start mt-20 lg:px-0 md:px-14">
                    <div class="flex flex-col self-center w-full xl:col-span-2 lg:col-span-3 col-span-5 ">
                        <div
                            class="bg-white/50 backdrop-opacity-95 backdrop-blur flex flex-col justify-around py-16 md:px-10 px-4 rounded-2xl border border-white ">
                            <h1 class="font-medium lg:text-4xl md:text-5xl text-3xl text-[#E80000] my-6 text-center">Unfortunately Failed</h1>
                            <div class="w-full px-10">
                                <p class="flex justify-center text-center font-medium">
                                    We noticed that your payment did not go through.<br/>
                                    We don't want you to miss out your booking, So if you have any trouble, don’t hesitate to contact us!
                                </p>
                            </div>
                            <div class=" lg:col-span-2 col-span-5 mt-8">
                                <div class="overflow-hidden sm:mx-0.5 lg:mx-0.5">
                                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                                        <div class="overflow-hidden ">
                                            <div class="overflow-x-auto" >
                                                <table class="table tabel-l table-zebra-f bg-lightGray ">
                                                    <!-- head -->
                                                    <tbody class="font-medium ">
                                                    <!-- row 1 -->
                                                    <tr>
                                                        <td class="w-1/2">Transaction Code</td>
                                                        <td class="text-center w-1/2">123e4567</td>
                                                    </tr>
                                                    <!-- row 2 -->
                                                    <tr>
                                                        <td>Transaction Info</td>
                                                        <td class="text-center">Invoice #465</td>
                                                    </tr>
                                                    <!-- row 3 -->
                                                    <tr>
                                                        <td>Authority Code</td>
                                                        <td class="text-center">123e4567e89b12d3a45642</td>
                                                    </tr>
                                                    <!-- row 4 -->
                                                    <tr>
                                                        <td>Amount</td>
                                                        <td class="text-center">470 $</td>
                                                    </tr>
                                                    <!-- row 5 -->
                                                    <tr>
                                                        <td>Status</td>
                                                        <td class="text-center">Failed</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <form>
                                            <button class="w-full mb-12 text-white mt-8 btn btn-primary bg-secondary hover:bg-secondary mb-3 rounded-2xl p-2 text-base border-hidden">Continue </button>
                                        </form>
                                    </div>
                                </div>

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
