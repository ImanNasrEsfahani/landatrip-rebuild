@auth
    @includeIf("tour.components.comments-form")
@elseauth
    <div class="bg-info p-4 pb-2 rounded-3 w-full md:w-75 lg:w-50 mx-auto mt-3 mb-5">
        <h5 class="text-lg mb-4 text-black text-center">Log in Or Register Now</h5>
        <div class="flex justify-between pb-3">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-white py-2 px-4" href="{{ route('login') }}">
                Button
            </button>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-white py-2 px-4" href="{{ route('register') }}">
                Button
            </button>
            <a class="btn btn-orange text-white py-2 px-4" >Log in</a>
            <a class="btn btn-orange text-white py-2 px-4" >Register</a>
        </div>
    </div>
@endauth