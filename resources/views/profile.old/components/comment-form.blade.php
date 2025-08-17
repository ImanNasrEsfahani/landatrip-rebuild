@auth
    <div class="row">
        <div class="col-2 px-0 align-self-center">
        <div class="mx-auto ratio ratio-1x1">
        @if(auth()->user()->profileImage)
            <img class="object-fit-cover ms-2 me-4 rounded-circle" src="{{ asset('/users/profile/' . auth()->user()->profileImage->url) }}" alt="{{auth()->user()->profileImage->alt}}">
        @else
            <img class="object-fit-cover ms-2 me-4 rounded-circle" src="{{ asset('/users/profile/') }}/{{ $user->sex === 2 ? "female.png" : "male.png" }}" alt="{{ $user->name }}">
        @endif
        </div>
        </div>
        <form class="col-auto d-flex flex-column flex-grow-1 h-fit align-self-center" action="{{ route('profile.post.comment.store', [$user, $post]) }}" method="POST">
            @csrf
            <div class="w-100 d-flex flex-column flex-lg-row ">
                <input class="bg-gray text-dark rounded-5 px-4 py-2 w-100 border-0" type="text" name="comment" id="" placeholder="{{ __('pages/profile.what do you want to talk about') }}">
                <button type="submit" class="bg-transparent border-0 px-0">
                    <span class="fa-stack fa-1x text-orange fs-4">
                      <i class="fa-solid fa-circle fa-stack-2x"></i>
                      <i class="fa-solid fa-paper-plane-top fa-stack-1x fa-inverse ps-1"></i>
                    </span>
                </button>
            </div>
        </form>
    </div>

    @if ($errors->get('comment'))
        <div class="alert alert-danger mt-3 rounded-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@else
    <div class="d-flex flex-row mt-3 mb-2">
        <i class="fa-solid fa-circle h-100 fs-9 text-gray me-2"></i>
        <input class="bg-gray text-dark rounded-5 px-4 py-2 w-100 border-0 disabled" type="text" placeholder="{{ __('pages/profile.Please login and put your comment here') }}" disabled/>
        <a class="btn btn-orange text-white align-self-center rounded-pill ms-2" href="{{ route('login') }}">Login</a>
    </div>
@endauth
