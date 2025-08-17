<div x-data="{ showModal:false }">
    <div x-data @login.window="showModal= true;">
        <div x-show.important="showModal" x-transition
             class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div @click.away="showModal = false"
                 class="bg-white p-8 rounded-lg w-1/2 relative bg-opacity-80 backdrop-blur">
                <button @click="showModal = false"
                        class="btn btn-xl btn-circle btn-ghost absolute right-2 top-2 text-black">✕
                </button>
                <p class="font-semibold">You Must Sign In or Sign Up to access this section</p>
                <div class="flex flex-row gap-3 mt-5 justify-end items-end">
                    <a href="{{ route('login',["previous_url"=>'/profile/'.$user->slug."/posts"]) }}"
                       class="btn btn-outline p-3 rounded-2xl normal-case">
                        Login In
                    </a>
                    <a href="{{ route('register') }}"
                       class="btn  p-3 rounded-2xl bg-black hover:bg-darkGray text-white normal-case">
                        Sign Up
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div x-data="users">
    <div x-data="{showUsersModal:false}" >
        <div  @followerpopup.window="showUsersModal=true; init($event.detail)" class="fixed inset-0 bg-black bg-opacity-50 flex items-center  justify-center z-50" x-show="showUsersModal" >
            <div @click.away="showUsersModal = false" class="bg-white p-8 rounded-lg w-full  md:w-1/3 relative backdrop-blur h-[80vh] overflow-hidden">
                <button @click="showUsersModal=false" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                <div class="flex flex-col gap-3 mt-8">
                    <div class="w-full bg-white shadow-xl flex justify-between p-4 rounded-xl items-center">
                        <div class="flex gap-4 font-semibold">
                            <button class="p-2" @click.prevent="change(1)" :class=" selected===true ? 'text-secondary border-0 border-b-2' : 'text-gray' " >Follower</button>
                            <button class="p-2" @click.prevent="change(2)" :class=" selected===false ? 'text-secondary border-0 border-b-2' : 'text-gray' " >Following</button>
                        </div>
                        <div class="">
                            <span x-text="resultsCount"></span>
                        </div>
                    </div>
                    <div class="bg-white shadow-xl rounded-xl p-4 flex items-center">
                        <div class="me-2">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_1980_19050)">
                                    <path d="M9 16C12.866 16 16 12.866 16 9C16 5.13401 12.866 2 9 2C5.13401 2 2 5.13401 2 9C2 12.866 5.13401 16 9 16Z" stroke="#646665" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M18 18L15 15" stroke="#646665" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                                <defs>
                                    <clipPath id="clip0_1980_19050">
                                        <rect width="20" height="20" fill="white"/>
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <div class="grow">
                            <input x-ref="searchInput" x-model="search"
                                   x-on:keydown.window.prevent.slash="$refs.searchInput.focus()"
                                   class="w-full outline-none bg" type="search" placeholder="search">
                        </div>
                    </div>
                    <div class="overflow-hidden">
                        <div class="flex flex-col gap-3 overflow-scroll max-h-[23rem]">
                            <template x-for="(item, index) in filteredUsers" :key="index">
                                <div class="bg-white shadow-xl flex flex-row rounded-xl justify-between p-3 gap-3 relative grow">
                                    <a wire:navigate.hover :href="'{{ route("profile", "") }}'+'/'+item.slug" class="after:absolute after:inset-0">
                                        <div class="flex gap-3">
                                            <img class="w-14 aspect-square object-cover rounded-full border-2"
                                                 :src="'{{ Storage::url('users/profile/') }}' + item.profile_image.url" >
                                            <div class="flex flex-col justify-between grow">
                                                <span class="font-semibold" x-text="item.name"></span>
                                                <span x-text="item.title"></span>
                                            </div>
                                        </div>
                                    </a>
                                    <svg class="hidden" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.9987 0.333496C3.3187 0.333496 0.332031 3.32016 0.332031 7.00016C0.332031 10.6802 3.3187 13.6668 6.9987 13.6668C10.6787 13.6668 13.6654 10.6802 13.6654 7.00016C13.6654 3.32016 10.6787 0.333496 6.9987 0.333496ZM10.8987 8.40016C10.872 8.46016 10.8387 8.5135 10.792 8.56016L8.76536 10.5868C8.66536 10.6868 8.5387 10.7335 8.41203 10.7335C8.28536 10.7335 8.1587 10.6868 8.0587 10.5868C7.86536 10.3935 7.86536 10.0735 8.0587 9.88016L9.23203 8.70683H3.56536C3.29203 8.70683 3.06536 8.48016 3.06536 8.20683C3.06536 7.9335 3.29203 7.70683 3.56536 7.70683H10.4387C10.5054 7.70683 10.5654 7.72016 10.632 7.74683C10.752 7.80016 10.852 7.8935 10.9054 8.02016C10.9454 8.14016 10.9454 8.28016 10.8987 8.40016ZM10.432 6.28683H3.56536C3.4987 6.28683 3.43203 6.2735 3.37203 6.24683C3.25203 6.1935 3.15203 6.10016 3.0987 5.9735C3.04536 5.8535 3.04536 5.7135 3.0987 5.5935C3.12536 5.5335 3.1587 5.48016 3.20536 5.4335L5.23203 3.40683C5.42536 3.2135 5.74536 3.2135 5.9387 3.40683C6.13203 3.60016 6.13203 3.92016 5.9387 4.1135L4.77203 5.28683H10.4387C10.712 5.28683 10.9387 5.5135 10.9387 5.78683C10.9387 6.06016 10.712 6.28683 10.432 6.28683Z" fill="#646665"/>
                                    </svg>

                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@script
<script>


    function change(id){
        const follower = @json($user->followers()->with("profileImage")->get());
        const following = @json($user->following()->with("profileImage")->get());
        this.allData = id === 1 ? follower : following;
    }

    Alpine.data('users', (id) => {
        return {
            selected:true,
            search: '',
            allData: allData,
            resultsCount: 0,
            get filteredUsers() {
                if (this.search === '') {
                    this.resultsCount = this.allData.length;
                    return this.allData;
                }

                const filteredResults = this.allData.filter((user) => {
                    return user.name
                        .replace(/ /g, '')
                        .toLowerCase()
                        .includes(this.search.replace(/ /g, '').toLowerCase());
                });
                this.resultsCount = filteredResults.length;
                return filteredResults;
            },
            init(id) {
                const follower = @json($user->followers()->with("profileImage")->get());
                const following = @json($user->following()->with("profileImage")->get());
                this.allData = id === 1 ? follower : following;
                this.selected = id === 1;
            },
            change(id){
                const follower = @json($user->followers()->with("profileImage")->get());
                const following = @json($user->following()->with("profileImage")->get());
                this.allData = id === 1 ? follower : following;
                this.selected = id === 1
            }
        }
    });



</script>
@endscript
