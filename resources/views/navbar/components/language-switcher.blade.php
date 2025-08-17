<div class="flex justify-start lg:justify-center pt-0 ml-2">
    <div class="language mb-0 h-full">
        <details class="dropdown dropdown-bottom dropdown-end">
            <summary tabindex="0" class="list-none	flex"><i class="flag:{{ ($available_locales->first(function ($value, $key) use ($current_locale) { return $value['slug'] === $current_locale; }))["flag"] }} rounded-[0.25rem] text-2xl"></i> <img src="{{ Storage::url('/website/navbar/arrow-down.svg')  }}" class=""></summary>
            <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-35 mt-3 z-50">
                @foreach($available_locales as $available_locale)
                    @if($available_locale["slug"] !== $current_locale)
                        <li>
                            <a href="{{ route('changeLanguage', $available_locale['slug']) }}" class="dropdown-item flex items-center py-2">
                                <span class="flag:{{ $available_locale['flag'] }} me-2"> </span> {{ $available_locale['name'] }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </details>
    </div>
</div>
