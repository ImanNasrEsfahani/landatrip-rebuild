<dialog id="login_popup" class="modal">
    <div class="modal-box bg-white bg-opacity-80 backdrop-blur ">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <p class="font-semibold">You Must Sign In or Sign Up to Post a Comment</p>
        <div class="flex flex-row gap-3 mt-5 justify-end items-end">
            <a href="{{ route('login',["previous_url"=>url()->current()."#reviews"]) }}" class="btn btn-outline p-3 rounded-2xl normal-case">
                Login In
            </a>
            <a href="{{ route('register') }}" class="btn  p-3 rounded-2xl bg-black hover:bg-darkGray text-white normal-case" >
                Sign Up
            </a>
        </div>
    </div>
</dialog>
