@if (auth()->check() and auth()->user()->communities()->where('community_id', '=', $community->id)->first())
    <div class="bg-white shadow w-100 h-auto rounded-3 mb-4 p-3">
        <div class="d-flex flex-row">
            @if(auth()->user()->profileImage)
                <img class="max-h-3rem ms-2 me-4 rounded-circle mt-auto"
                     src="{{ asset('/user/profile/' . auth()->user()->profileImage?->url) }}"
                     alt="{{ asset('/user/profile/' . auth()->user()->profileImage?->alt) }}">
            @else
                <img class="max-h-3rem ms-2 me-4 rounded-circle mt-auto"
                     src="{{ asset('/user/profile/') }}/{{ auth()->user()->sex === 2 ? "female.png" : "male.png" }}"
                     alt="{{ auth()->user()->name }}">
            @endif
            <form class="d-flex flex-column flex-grow-1 h-fit align-self-center"
                  action="{{ route('community.post.store', $community) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input
                    class="bg-gray rounded-pill text-dark px-4 py-2 mb-2 w-100 w-lg-50 form-control @error('location') is-invalid @else border-0 @enderror"
                    type="text" name="location" id="location" value="{{ old('location') }}"
                    placeholder="{{ __('pages/community.Where is it') }}">

                <div class="w-100 d-flex flex-column flex-lg-row ">
                    <input
                        class="bg-gray rounded-pill text-dark px-4 py-2 w-100 form-control @error('title') is-invalid @else border-0 @enderror"
                        type="text" name="title" id="title" value="{{ old('title') }}"
                        placeholder="{{ __('pages/community.What do you want to talk about') }}">

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
                @if ($errors->get('location') or $errors->get('title') or $errors->get('image') or $errors->get('follow'))
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
