@if(auth()->check())
    @if($user->id === auth()->user()->id)
        <div class="bg-white rounded-4 shadow py-3 px-2 mb-4">
            <div class="row w-100 mx-auto">
                <div class="col-2 px-0 align-self-end">
                    <div class="ratio ratio-1x1">
                        @if($user->profileImage)
                            <img class="object-fit-cover ms-2 me-4 rounded-pill"
                                 src="{{ asset('/users/profile/' . $user->profileImage?->url) }}" alt="{{ ($user->profileImage?->alt) }}">
                        @else
                            <img class="object-fit-cover ms-2 me-4 rounded-circle"
                                 src="{{ asset('/users/profile/') }}/{{ $user->sex === 2 ? "female.png" : "male.png" }}"
                                 alt="{{ $user->name }}">
                        @endif
                    </div>
                </div>
                <form class="col-auto d-flex flex-column flex-grow-1 h-fit align-self-center"
                      action="{{ route('userPost.post.store', $user) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input
                        class="bg-gray rounded-pill text-dark px-4 py-2 mb-2 w-100 w-lg-50 form-control @error('location') is-invalid @else border-0 @enderror"
                        type="text" name="location" id="location" value="{{ old('location') }}"
                        placeholder="{{ __('pages/profile.where is it') }}">

                    <div class="w-100 d-flex flex-column flex-lg-row ">
                        <input
                            class="bg-gray rounded-pill text-dark px-4 py-2 w-100 form-control @error('title') is-invalid @else border-0 @enderror"
                            type="text" name="title" id="title" value="{{ old('title') }}"
                            placeholder="{{ __('pages/profile.What do you want to talk about') }}"/>

                        <div class="d-flex flex-row mt-2 mt-lg-0 justify-content-end">
                            <label for="image" class="align-self-center px-2">
                                <i class="fa-solid fa-cloud-arrow-up text-orange fs-8"></i>
                            </label>
                            <input class="d-none" type="file" name="image" id="image" accept="image/*"/>

                            {{--                        <div class="rounded-circle overflow-hidden bg-orange">--}}
                            {{--                            <button type="submit" class="btn btn-orange rounded-circle py-2 text-white">--}}
                            {{--                                <i class="fa-sharp fa-solid fa-paper-plane-top text-white"></i>--}}
                            {{--                            </button>--}}
                            {{--                        </div>--}}

                            <button type="submit" class="bg-transparent border-0 px-0">
                            <span class="fa-stack fa-1x text-orange fs-4">
                              <i class="fa-solid fa-circle fa-stack-2x"></i>
                              <i class="fa-solid fa-paper-plane-top fa-stack-1x fa-inverse ps-1"></i>
                            </span>
                            </button>
                        </div>
                    </div>

                    @if ($errors->get('location') or $errors->get('title') or $errors->get('image'))
                        <div class="alert alert-danger mt-3 rounded-4">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    @endif
@else
    <div class="bg-white rounded-4 shadow p-3 mb-4">
        <div class="d-flex flex-row align-items-center">
            @if($user->profileImage)
                <img class="max-w-3rem d-block mx-2 rounded-circle"
                     src="{{ asset('/users/profile/' . $user->profileImage?->url) }}"
                     alt="{{ asset('/users/profile/' . $user->profileImage?->alt) }}">
            @else
                <img class="max-w-3rem d-block mx-2 rounded-circle"
                     src="{{ asset('/users/profile/') }}/{{ $user->sex === 2 ? "female.png" : "male.png" }}"
                     alt="{{ $user->name }}">
            @endif
            <input class="bg-gray rounded-pill text-dark px-4 py-2 w-100 form-control disabled" type="text" id="title"
                   placeholder="Please login and put your post here" disabled/>
            <a class="btn btn-orange text-white align-self-center rounded-pill ms-2"
               href="{{ route('login') }}">Login</a>
            </button>
        </div>
    </div>
@endif
