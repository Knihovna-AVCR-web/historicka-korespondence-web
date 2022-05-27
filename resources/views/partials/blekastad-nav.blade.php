@if (!empty($blekastadNavigation))
    <nav
        class="flex flex-col flex-wrap items-start justify-between w-full px-5 py-2 text-sm bg-red-700 shadow-md lg:flex-row">
        @foreach ($blekastadNavigation->toArray() as $item)
            @if ($loop->first)
                <a href="{{ $item->url }}" class="flex items-center py-2 mr-6 italic text-white">
                    <div class="hidden w-16 h-auto mr-6 lg:block"></div>
                    {{ $item->label }}
                </a>
            @endif
        @endforeach
        <nav class="flex flex-col lg:flex-row">
            @foreach ($blekastadNavigation->toArray() as $item)
                @continue($loop->first)
                <a href="{{ $item->url }}" class="block m-2 text-white"
                    @if (!empty($item->target)) target="{{ $children->target }}" @endif>
                    {{ $item->label }}
                </a>
            @endforeach
        </nav>
    </nav>
@endif
