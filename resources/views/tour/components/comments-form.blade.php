<div class="my-32 w-95" id="leave-review">
    <p class="mb-10 font-bold align-center text-h4">Leave a Review</p>
    <form action="{{ route('comment.store', $tour) }}" method="POST" @if(!auth()->user()) onsubmit="loginHandler(event)" @endif>
        @csrf
        <div class="flex items-center gap-x-5 w-full pl-5">
            <p class="text-black font-medium">Rate:</p>
            <div class="rating rating-md">
                @for ($i =1; $i <=5; $i++)
                    <input type="radio" name="star" class="mask mask-star-2 bg-secondary me-1" id="star{{ $i }}"
                        value={{ $i }} @if($i === 5) checked @endif/>
                @endfor
            </div>
        </div>
        <textarea
            placeholder="Write Your Comment Here…"
            class="textarea textarea-bordered textarea-md min-h-6 w-full shadow mt-5 border-none" name="comment"
            rows="4"
        >{{ old('comment') }}</textarea>
        <input class="btn btn-primary block mt-5 rounded-xl h-8 text-white text-md font-normal min-h-0 px-5 ml-auto"  type="submit" value="Post" />
    </form>
</div>


