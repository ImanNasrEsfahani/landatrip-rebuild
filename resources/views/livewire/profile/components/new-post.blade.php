<div class="bg-white shadow-xl p-8 rounded-2xl">
    <form>
        <div class="flex flex-row justify-between gap-4">
        <textarea class="bg-lightGray rounded-xl w-full focus:border-none focus:outline-none p-2" wire:model.live="title" rows="@if($title) 5 @else 1 @endif" placeholder="what do you want to talk about?"></textarea>
        </div>
        <div class="mt-8 flex flex-row gap-5 justify-between" x-data="{ uploading: false, progress: 0 }"
            x-on:livewire-upload-start="uploading = true"
            x-on:livewire-upload-finish="uploading = false"
            x-on:livewire-upload-error="uploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress">
            <div class="flex @if($title || $media || $location || $group_id) border border-info p-1 rounded-lg @endif" x-data='{addressSelected(e) {
            let value = e.target.value
            let id = document.body.querySelector("datalist [value=\""+value+"\"]").dataset.value}}'>
                <label class="flex flex-row text-lg font-semibold text-mediumGray cursor-pointer items-center" for="location">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.00016 10.6276C7.40266 10.6276 6.09766 9.33008 6.09766 7.72508C6.09766 6.12008 7.40266 4.83008 9.00016 4.83008C10.5977 4.83008 11.9027 6.12758 11.9027 7.73258C11.9027 9.33758 10.5977 10.6276 9.00016 10.6276ZM9.00016 5.95508C8.02516 5.95508 7.22266 6.75008 7.22266 7.73258C7.22266 8.71508 8.01766 9.51008 9.00016 9.51008C9.98266 9.51008 10.7777 8.71508 10.7777 7.73258C10.7777 6.75008 9.97516 5.95508 9.00016 5.95508Z" fill="#646665"/>
                        <path d="M9.00123 17.07C7.89123 17.07 6.77373 16.65 5.90373 15.8175C3.69123 13.6875 1.24623 10.29 2.16873 6.2475C3.00123 2.58 6.20373 0.9375 9.00123 0.9375C9.00123 0.9375 9.00123 0.9375 9.00873 0.9375C11.8062 0.9375 15.0087 2.58 15.8412 6.255C16.7562 10.2975 14.3112 13.6875 12.0987 15.8175C11.2287 16.65 10.1112 17.07 9.00123 17.07ZM9.00123 2.0625C6.81873 2.0625 4.01373 3.225 3.27123 6.495C2.46123 10.0275 4.68123 13.0725 6.69123 15C7.98873 16.2525 10.0212 16.2525 11.3187 15C13.3212 13.0725 15.5412 10.0275 14.7462 6.495C13.9962 3.225 11.1837 2.0625 9.00123 2.0625Z" fill="#646665"/>
                    </svg>
                </label>
                <input
                    id="location"
                    type="text"
                    list="locationOptions"
                    wire:model.live="location"
                    class="focus:border-none focus:outline-none ms-2"
                    placeholder="Add Location"
                    x-on:change.debounce="addressSelected($event)"
                >
                <datalist id="locationOptions" class="bg-white">
                    @foreach($searchResults as $result)
                        <option
                            wire:key="{{ $result }}"
                            data-value="{{ $result }}"
                            value="{{ $result }}"
                        ></option>
                    @endforeach
                </datalist>
            </div>
                @error('location') <span class="error">{{ $message }}</span> @enderror
            @if(auth()->user()->groups->count() > 0)
                <div class="flex @if($title || $media || $location || $group_id) border border-info p-1 rounded-lg @endif">
                    <label class="flex flex-row text-lg font-semibold text-mediumGray cursor-pointer items-center" for="data-te-select-init">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.999 6.59148C14.974 6.59148 14.9573 6.59148 14.9323 6.59148H14.8906C13.3156 6.54148 12.1406 5.32481 12.1406 3.82481C12.1406 2.29147 13.3906 1.0498 14.9156 1.0498C16.4406 1.0498 17.6906 2.29981 17.6906 3.82481C17.6823 5.33314 16.5073 6.54981 15.0073 6.59981C15.0073 6.59147 15.0073 6.59148 14.999 6.59148ZM14.9156 2.29148C14.074 2.29148 13.3906 2.97481 13.3906 3.81648C13.3906 4.64148 14.0323 5.30815 14.8573 5.34148C14.8656 5.33315 14.9323 5.33315 15.0073 5.34148C15.8156 5.29981 16.4406 4.63314 16.449 3.81648C16.449 2.97481 15.7656 2.29148 14.9156 2.29148Z" fill="#646665"/>
                            <path d="M15.0097 12.7334C14.6847 12.7334 14.3597 12.7084 14.0347 12.65C13.6931 12.5917 13.4681 12.2667 13.5264 11.925C13.5847 11.5834 13.9097 11.3584 14.2514 11.4167C15.2764 11.5917 16.3597 11.4 17.0847 10.9167C17.4764 10.6584 17.6847 10.3334 17.6847 10.0084C17.6847 9.68337 17.4681 9.3667 17.0847 9.10837C16.3597 8.62504 15.2597 8.43337 14.2264 8.61671C13.8847 8.68337 13.5597 8.45004 13.5014 8.10837C13.4431 7.76671 13.6681 7.44171 14.0097 7.38338C15.3681 7.14171 16.7764 7.40004 17.7764 8.0667C18.5097 8.55837 18.9347 9.25837 18.9347 10.0084C18.9347 10.75 18.5181 11.4584 17.7764 11.9584C17.0181 12.4584 16.0347 12.7334 15.0097 12.7334Z" fill="#646665"/>
                            <path d="M4.97344 6.59151C4.96511 6.59151 4.95677 6.59151 4.95677 6.59151C3.45677 6.54151 2.28177 5.32483 2.27344 3.82483C2.27344 2.2915 3.52344 1.0415 5.04844 1.0415C6.57344 1.0415 7.82344 2.29151 7.82344 3.81651C7.82344 5.32484 6.64844 6.54151 5.14844 6.59151L4.97344 5.96651L5.03177 6.59151C5.01511 6.59151 4.99011 6.59151 4.97344 6.59151ZM5.05677 5.34151C5.10677 5.34151 5.14844 5.3415 5.19844 5.34984C5.94011 5.3165 6.5901 4.64983 6.5901 3.82483C6.5901 2.98317 5.90677 2.29983 5.06511 2.29983C4.22344 2.29983 3.5401 2.98317 3.5401 3.82483C3.5401 4.6415 4.17344 5.29984 4.98177 5.34984C4.9901 5.3415 5.02344 5.34151 5.05677 5.34151Z" fill="#646665"/>
                            <path d="M4.96797 12.7334C3.94297 12.7334 2.95964 12.4584 2.2013 11.9584C1.46797 11.4667 1.04297 10.7584 1.04297 10.0084C1.04297 9.26671 1.46797 8.55837 2.2013 8.0667C3.2013 7.40004 4.60964 7.14171 5.96797 7.38338C6.30964 7.44171 6.53464 7.76671 6.4763 8.10837C6.41797 8.45004 6.09297 8.68337 5.7513 8.61671C4.71797 8.43337 3.6263 8.62504 2.89297 9.10837C2.5013 9.3667 2.29297 9.68337 2.29297 10.0084C2.29297 10.3334 2.50964 10.6584 2.89297 10.9167C3.61797 11.4 4.7013 11.5917 5.7263 11.4167C6.06797 11.3584 6.39297 11.5917 6.4513 11.925C6.50964 12.2667 6.28464 12.5917 5.94297 12.65C5.61797 12.7084 5.29297 12.7334 4.96797 12.7334Z" fill="#646665"/>
                            <path d="M9.99896 12.8166C9.97396 12.8166 9.95729 12.8166 9.93229 12.8166H9.89062C8.31562 12.7666 7.14062 11.5499 7.14062 10.0499C7.14062 8.51657 8.39063 7.2749 9.91563 7.2749C11.4406 7.2749 12.6906 8.5249 12.6906 10.0499C12.6823 11.5582 11.5073 12.7749 10.0073 12.8249C10.0073 12.8166 10.0073 12.8166 9.99896 12.8166ZM9.91563 8.51657C9.07396 8.51657 8.39062 9.19991 8.39062 10.0416C8.39062 10.8666 9.03229 11.5332 9.85729 11.5666C9.86563 11.5582 9.93229 11.5582 10.0073 11.5666C10.8156 11.5249 11.4406 10.8582 11.449 10.0416C11.449 9.20824 10.7656 8.51657 9.91563 8.51657Z" fill="#646665"/>
                            <path d="M9.99974 18.9666C8.99974 18.9666 7.99974 18.7083 7.22474 18.1833C6.49141 17.6916 6.06641 16.9916 6.06641 16.2416C6.06641 15.4999 6.48307 14.7833 7.22474 14.2916C8.78307 13.2583 11.2247 13.2583 12.7747 14.2916C13.5081 14.7833 13.9331 15.4833 13.9331 16.2333C13.9331 16.9749 13.5164 17.6916 12.7747 18.1833C11.9997 18.6999 10.9997 18.9666 9.99974 18.9666ZM7.91641 15.3416C7.52474 15.5999 7.31641 15.9249 7.31641 16.2499C7.31641 16.5749 7.53307 16.8916 7.91641 17.1499C9.04141 17.9083 10.9497 17.9083 12.0747 17.1499C12.4664 16.8916 12.6747 16.5666 12.6747 16.2416C12.6747 15.9166 12.4581 15.5999 12.0747 15.3416C10.9581 14.5833 9.04974 14.5916 7.91641 15.3416Z" fill="#646665"/>
                        </svg>
                    </label>
                    <select data-te-select-clear-button="true" wire:model.live="group_id" data-te-select-init class="focus:border-none focus:outline-none w-[200px]">
                        <option value="">Add Group</option>
                        @forelse(auth()->user()->groups as $group)
                            <option class="" value="{{$group->id}}">{{$group->title}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            @endif
            <div class="flex items-center">
                <div>
                    <label class="flex flex-row text-lg font-semibold text-mediumGray cursor-pointer items-center" for="media">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.25 17.0625H6.75C2.6775 17.0625 0.9375 15.3225 0.9375 11.25V6.75C0.9375 2.6775 2.6775 0.9375 6.75 0.9375H11.25C15.3225 0.9375 17.0625 2.6775 17.0625 6.75V11.25C17.0625 15.3225 15.3225 17.0625 11.25 17.0625ZM6.75 2.0625C3.2925 2.0625 2.0625 3.2925 2.0625 6.75V11.25C2.0625 14.7075 3.2925 15.9375 6.75 15.9375H11.25C14.7075 15.9375 15.9375 14.7075 15.9375 11.25V6.75C15.9375 3.2925 14.7075 2.0625 11.25 2.0625H6.75Z" fill="#646665"/>
                            <path d="M6.75 8.0625C5.61 8.0625 4.6875 7.14 4.6875 6C4.6875 4.86 5.61 3.9375 6.75 3.9375C7.89 3.9375 8.8125 4.86 8.8125 6C8.8125 7.14 7.89 8.0625 6.75 8.0625ZM6.75 5.0625C6.2325 5.0625 5.8125 5.4825 5.8125 6C5.8125 6.5175 6.2325 6.9375 6.75 6.9375C7.2675 6.9375 7.6875 6.5175 7.6875 6C7.6875 5.4825 7.2675 5.0625 6.75 5.0625Z" fill="#646665"/>
                            <path d="M2.0016 14.7749C1.8216 14.7749 1.6416 14.6849 1.5366 14.5274C1.3641 14.2724 1.4316 13.9199 1.6941 13.7474L5.3916 11.2649C6.2016 10.7174 7.3191 10.7849 8.0541 11.4074L8.3016 11.6249C8.6766 11.9474 9.3141 11.9474 9.6816 11.6249L12.8016 8.94742C13.5966 8.26492 14.8491 8.26492 15.6516 8.94742L16.8741 9.99742C17.1066 10.1999 17.1366 10.5524 16.9341 10.7924C16.7316 11.0249 16.3791 11.0549 16.1391 10.8524L14.9166 9.80242C14.5416 9.47992 13.9041 9.47992 13.5291 9.80242L10.4091 12.4799C9.6141 13.1624 8.3616 13.1624 7.5591 12.4799L7.3116 12.2624C6.9666 11.9699 6.3966 11.9399 6.0141 12.2024L2.3166 14.6849C2.2191 14.7449 2.1066 14.7749 2.0016 14.7749Z" fill="#646665"/>
                        </svg>
                        <span class="ms-1 font-light">
                        Media
                    </span>
                    </label>
                    <input class="hidden"  type="file" id="media"  wire:model="media" multiple>
                </div>
                <div x-show="uploading" class="w-[100px] flex items-center">
                    <progress class="progress progress-primary w-full mx-1" max="100" x-bind:value="progress"></progress>
                    <span class="font-light" ><span x-text="progress"></span>%</span>
                </div>
                @if($media)
                    <div x-show="!uploading && progress==100">
                        <span class="text-primary font-light ms-2">Upload Completed</span>
                    </div>
                @endif

            </div>
            @error('media') <span class="error">{{ $message }}</span> @enderror
            @if(auth()->user()->userPosts->where('is_drafted', true)->count())
                <button class="flex items-center text-info font-light" @click.prevent="$dispatch('draftpopup', true)">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.55 17.0625H5.7C2.4075 17.0625 0.9375 15.5925 0.9375 12.3V9.45C0.9375 6.1575 2.4075 4.6875 5.7 4.6875H7.95C8.2575 4.6875 8.5125 4.9425 8.5125 5.25C8.5125 5.5575 8.2575 5.8125 7.95 5.8125H5.7C3.015 5.8125 2.0625 6.765 2.0625 9.45V12.3C2.0625 14.985 3.015 15.9375 5.7 15.9375H8.55C11.235 15.9375 12.1875 14.985 12.1875 12.3V10.05C12.1875 9.7425 12.4425 9.4875 12.75 9.4875C13.0575 9.4875 13.3125 9.7425 13.3125 10.05V12.3C13.3125 15.5925 11.8425 17.0625 8.55 17.0625Z" fill="#646665"/>
                        <path d="M12.7492 10.6124H10.3492C8.24172 10.6124 7.38672 9.75737 7.38672 7.64987V5.24987C7.38672 5.02487 7.52172 4.81487 7.73172 4.73237C7.94172 4.64237 8.18172 4.69487 8.34672 4.85237L13.1467 9.65237C13.3042 9.80987 13.3567 10.0574 13.2667 10.2674C13.1842 10.4774 12.9742 10.6124 12.7492 10.6124ZM8.51172 6.60737V7.64987C8.51172 9.14237 8.85672 9.48737 10.3492 9.48737H11.3917L8.51172 6.60737Z" fill="#646665"/>
                        <path d="M11.6992 2.0625H8.69922C8.39172 2.0625 8.13672 1.8075 8.13672 1.5C8.13672 1.1925 8.39172 0.9375 8.69922 0.9375H11.6992C12.0067 0.9375 12.2617 1.1925 12.2617 1.5C12.2617 1.8075 12.0067 2.0625 11.6992 2.0625Z" fill="#646665"/>
                        <path d="M5.25 4.3125C4.9425 4.3125 4.6875 4.0575 4.6875 3.75C4.6875 2.1975 5.9475 0.9375 7.5 0.9375H9.465C9.7725 0.9375 10.0275 1.1925 10.0275 1.5C10.0275 1.8075 9.7725 2.0625 9.465 2.0625H7.5C6.57 2.0625 5.8125 2.82 5.8125 3.75C5.8125 4.0575 5.5575 4.3125 5.25 4.3125Z" fill="#646665"/>
                        <path d="M14.3906 13.3125C14.0831 13.3125 13.8281 13.0575 13.8281 12.75C13.8281 12.4425 14.0831 12.1875 14.3906 12.1875C15.2456 12.1875 15.9356 11.49 15.9356 10.6425V6C15.9356 5.6925 16.1906 5.4375 16.4981 5.4375C16.8056 5.4375 17.0606 5.6925 17.0606 6V10.6425C17.0606 12.1125 15.8606 13.3125 14.3906 13.3125Z" fill="#646665"/>
                        <path d="M16.5 6.56237H14.25C12.255 6.56237 11.4375 5.74487 11.4375 3.74987V1.49987C11.4375 1.27487 11.5725 1.06487 11.7825 0.982369C11.9925 0.892369 12.2325 0.94487 12.3975 1.10237L16.8975 5.60237C17.055 5.75987 17.1075 6.00737 17.0175 6.21737C16.935 6.42737 16.725 6.56237 16.5 6.56237ZM12.5625 2.85737V3.74987C12.5625 5.12237 12.8775 5.43737 14.25 5.43737H15.1425L12.5625 2.85737Z" fill="#646665"/>
                    </svg>
                    <span class="ms-1">Draft</span>
                </button>

            @endif
        </div>
        @if ($media)
            <div class="flex mt-5">
                @foreach ($media as $key => $img)
{{--                    @dd( $img->temporaryUrl() )--}}
                <img src="{{ $img->temporaryUrl() }}">
                    <div class="relative space-x-2">
                        <button class="absolute top-1 end-1" wire:click.prevent="deleteImage({{ $key }})">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g filter="url(#filter0_b_3174_22352)">
                                    <circle cx="10" cy="10" r="10" fill="white" fill-opacity="0.5"/>
                                </g>
                                <g clip-path="url(#clip0_3174_22352)">
                                    <path d="M13.8225 6.18354C13.5859 5.94691 13.2036 5.94691 12.967 6.18354L10 9.14448L7.03299 6.17747C6.79636 5.94084 6.41411 5.94084 6.17747 6.17747C5.94084 6.41411 5.94084 6.79636 6.17747 7.03299L9.14448 10L6.17747 12.967C5.94084 13.2036 5.94084 13.5859 6.17747 13.8225C6.41411 14.0592 6.79636 14.0592 7.03299 13.8225L10 10.8555L12.967 13.8225C13.2036 14.0592 13.5859 14.0592 13.8225 13.8225C14.0592 13.5859 14.0592 13.2036 13.8225 12.967L10.8555 10L13.8225 7.03299C14.0531 6.80243 14.0531 6.41411 13.8225 6.18354Z" fill="#DC3545"/>
                                </g>
                                <defs>
                                    <filter id="filter0_b_3174_22352" x="-8" y="-8" width="36" height="36" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                        <feFlood flood-opacity="0" result="BackgroundImageFix"/>
                                        <feGaussianBlur in="BackgroundImageFix" stdDeviation="4"/>
                                        <feComposite in2="SourceAlpha" operator="in" result="effect1_backgroundBlur_3174_22352"/>
                                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_backgroundBlur_3174_22352" result="shape"/>
                                    </filter>
                                    <clipPath id="clip0_3174_22352">
                                        <rect width="12" height="12" fill="white" transform="translate(4 4)"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </button>
                        <img class="w-20 rounded-md aspect-square object-cover" src="{{ $img->temporaryUrl() }}" alt="preview">
                    </div>
                @endforeach
            </div>
        @endif
        <hr class="my-4 text-gray">
        <div class="flex @if($media) justify-between @else justify-end @endif">
            @if($media)
                <div class="flex-none"><button class="p-1 font-light text-red-600" wire:click.prevent="discard">Discard</button></div>
                <div class="grow text-end me-3"><button class="p-2 font-light text-primary rounded-xl border border-primary" wire:click.prevent="save_post(true)">Save Draft</button></div>
            @endif
                <div class="flex-none"><button @unless($media) disabled @endunless class="p-2 px-4 font-light text-white rounded-xl bg-primary" wire:click.prevent="save_post">Send Post</button></div>
        </div>
    </form>
</div>
