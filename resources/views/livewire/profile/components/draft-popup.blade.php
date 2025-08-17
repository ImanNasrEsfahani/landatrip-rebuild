@if(auth()->user())
    <div x-data="{ showDraftModal:false }">
        <div x-data @draftpopup.window="showDraftModal= $event.detail;">
            <div x-show.important="showDraftModal" x-transition
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div @click.away="showDraftModal = false"
                    class="bg-white p-8 rounded-lg w-1/2 relative bg-opacity-80 backdrop-blur">
                    <button @click="showDraftModal = false"
                        class="btn btn-xl btn-circle btn-ghost absolute right-2 top-2 text-black">✕
                    </button>
                    <p class="font-semibold text-2xl">Draft</p>
                    <div class="flex flex-row gap-3 mt-5 justify-end items-end">
                        @forelse(auth()->user()->userPosts as $post)
                            @if($post->is_drafted)
                                <div class="flex justify-end">
                                    @if(str_contains($post->images[0]->file_type, 'video'))
                                        <button wire:click="setDraft('{{$post->id}}')" >
                                            <img class="absolute w-9 end-2 top-2" src="{{ Storage::url('/posts/posts-icon/video.svg') }}" />
                                            <video class="aspect-square object-cover rounded w-full" autoplay muted loop>
                                                <source src="{{ Storage::url('posts/'.$post->images[0]->url) }}" type="video/mp4">
                                            </video>
                                            @else
                                                <div class="relative">
                                                    <img class="aspect-square object-cover rounded w-[10rem]" wire:click="setDraft('{{$post->id}}')" alt="name of the post" src="{{ Storage::url('/posts/'.$post->images->first()->url) }}">
                                                    <img class="absolute w-9 end-2 top-2"  src="{{ Storage::url('/posts/posts-icon/'.($post->images->count() === 1 ? "gallery.svg":"multi-media.svg")) }}" />
                                                    <button class="bg-red-600 rounded-lg p-1 absolute bottom-2 end-2" wire:click="deleteDraft('{{$post->id}}')"><svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M17.9991 5.60839C17.9824 5.60839 17.9574 5.60839 17.9324 5.60839C13.5241 5.16673 9.12408 5.00006 4.76574 5.44173L3.06574 5.60839C2.71574 5.64173 2.40741 5.39173 2.37408 5.04173C2.34074 4.69173 2.59074 4.39173 2.93241 4.35839L4.63241 4.19173C9.06574 3.74173 13.5574 3.91673 18.0574 4.35839C18.3991 4.39173 18.6491 4.70006 18.6157 5.04173C18.5907 5.36673 18.3157 5.60839 17.9991 5.60839Z" fill="white"/>
                                                            <path d="M7.58265 4.7665C7.54932 4.7665 7.51598 4.7665 7.47432 4.75817C7.14098 4.69984 6.90765 4.37484 6.96598 4.0415L7.14932 2.94984C7.28265 2.14984 7.46598 1.0415 9.40765 1.0415H11.591C13.541 1.0415 13.7243 2.1915 13.8493 2.95817L14.0326 4.0415C14.091 4.38317 13.8576 4.70817 13.5243 4.75817C13.1826 4.8165 12.8576 4.58317 12.8076 4.24984L12.6243 3.1665C12.5076 2.4415 12.4826 2.29984 11.5993 2.29984H9.41598C8.53265 2.29984 8.51598 2.4165 8.39098 3.15817L8.19932 4.2415C8.14932 4.54984 7.88265 4.7665 7.58265 4.7665Z" fill="white"/>
                                                            <path d="M13.174 18.9582H7.82402C4.91569 18.9582 4.79902 17.3498 4.70735 16.0498L4.16569 7.65815C4.14069 7.31649 4.40735 7.01649 4.74902 6.99149C5.09902 6.97482 5.39069 7.23315 5.41569 7.57482L5.95735 15.9665C6.04902 17.2332 6.08235 17.7082 7.82402 17.7082H13.174C14.924 17.7082 14.9574 17.2332 15.0407 15.9665L15.5824 7.57482C15.6074 7.23315 15.9074 6.97482 16.249 6.99149C16.5907 7.01649 16.8574 7.30815 16.8324 7.65815L16.2907 16.0498C16.199 17.3498 16.0824 18.9582 13.174 18.9582Z" fill="white"/>
                                                            <path d="M11.8844 14.375H9.10938C8.76771 14.375 8.48438 14.0917 8.48438 13.75C8.48438 13.4083 8.76771 13.125 9.10938 13.125H11.8844C12.226 13.125 12.5094 13.4083 12.5094 13.75C12.5094 14.0917 12.226 14.375 11.8844 14.375Z" fill="white"/>
                                                            <path d="M12.5846 11.0415H8.41797C8.0763 11.0415 7.79297 10.7582 7.79297 10.4165C7.79297 10.0748 8.0763 9.7915 8.41797 9.7915H12.5846C12.9263 9.7915 13.2096 10.0748 13.2096 10.4165C13.2096 10.7582 12.9263 11.0415 12.5846 11.0415Z" fill="white"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                        </button>
                                    @endif
                                </div>
                            @endif
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
