{{--<div class="group-chat" map="{{$group->groupPosts()->get()}}">--}}


{{--    @forelse($group->groupPosts()->get() as $item)--}}
{{--        <div class="d-flex  @if(auth()->id() === $item->user->id) flex-row-reverse @else flex-row @endif mb-3 px-1">--}}
{{--            <div class="px-1">--}}
{{--                <a class="text-decoration-none" href="{{ route("profile.show", $item->user) }}">--}}
{{--                    @if($item->user->profileImage)--}}
{{--                        <img class="max-h-3rem rounded-circle"--}}
{{--                             src="{{ asset('/storage/user/profile/' . $item->user->profileImage?->url) }}"--}}
{{--                             alt="{{ asset('/storage/user/profile/' . $item->user->profileImage?->alt) }}">--}}
{{--                    @else--}}
{{--                        <img class="max-h-3rem rounded-circle"--}}
{{--                             src="{{ asset('/storage/user/profile/') }}/{{ $item->user->sex === 2 ? "female.png" : "male.png" }}"--}}
{{--                             alt="{{ $item->user->name }}">--}}
{{--                    @endif--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div class="rounded-3 bg-gray @if(auth()->id() === $item->user->id) me-3 @else ms-3 @endif p-2 pe-3 w-auto">--}}
{{--                <a class="text-decoration-none" href="{{ route("profile.show", $item->user) }}">--}}
{{--                    <h6 class="pt-2 px-2 text-green fw-bold">{{ $item->user->fname }} {{ $item->user->lname }}</h6>--}}
{{--                </a>--}}
{{--                <p class="px-2 text-black">{{ $item->message }}</p>--}}
{{--                <span--}}
{{--                    class="d-flex flex-row justify-content-end fs-1 text-dark-gray">{{ \Carbon\Carbon::create($item->created_at)->format("M d, H:m") }}</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @empty--}}
{{--        <h3 class="text-danger">{{ __('pages/group.There is not any message') }}</h3>--}}
{{--    @endforelse--}}


{{--</div>--}}
{{--@includeIf("group.components.new-post")--}}
<div id="group-chat-react" group="{{ $group }}" auth="{{ auth()->user() }}"></div>

