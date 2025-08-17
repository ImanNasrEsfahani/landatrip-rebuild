@auth
    <div class="d-flex flex-column pb-3">
        <div class="d-flex flex-row">
            @if(auth()->user()->profileImage)

                <img class="max-h-3rem ms-2 me-4 rounded-circle"
                     src="{{ asset('/user/profile/' . auth()->user()->profileImage?->url) }}"
                     alt="{{ asset('e/user/profile/' . auth()->user()->profileImage?->alt) }}">

            @else
                <img class="max-h-3rem ms-2 me-4 rounded-circle"
                     src="{{ asset('/user/profile/') }}/{{ auth()->user()->sex === 2 ? "female.png" : "male.png" }}"
                     alt="{{ auth()->user()->name }}">
            @endif
            <form class="d-flex flex-grow-1 h-fit align-self-center"
                  action="{{ route('community.userPost.comment.store', [$community, $post]) }}" method="POST">
                @csrf
                <label class="form-label w-100 mb-0">
                    <input
                        class="bg-gray text-dark rounded-5 px-4 py-2 w-100 form-control @error('comment') is-invalid @else border-0 @endError"
                        type="text" name="comment" id=""
                        placeholder="{{ __('pages/community.what do you want to talk about?') }}">
                </label>
                <button type="submit" class="bg-transparent border-0">
                    <span class="fa-stack fa-1x text-orange fs-4">
                      <i class="fa-solid fa-circle fa-stack-2x"></i>
                      <i class="fa-solid fa-paper-plane-top fa-stack-1x fa-inverse ps-1"></i>
                    </span>
                </button>
            </form>
        </div>

        @if ($errors->get('comment'))
            <div class="alert alert-danger mt-3 p-2 rounded-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

@else
    <div class="d-flex flex-row mb-3">
        <i class="fa-solid fa-circle h-100 fs-9 text-gray me-2"></i>
        <label class="form-label w-100">
            <input class="bg-gray text-dark rounded-5 px-4 py-2 w-100 form-control disabled" type="text"
                   placeholder="{{ __('pages/community.Please Login and write your comment') }}" disabled/>
        </label>
        <a class="btn btn-orange text-white align-self-center rounded-pill ms-2" href="{{ route('login') }}">Login</a>
    </div>
@endauth
