<nav aria-label="breadcrumb">
    <ol class="flex flex-wrap p-0 mb-6 text-sm text-red-700 list-none">
        @foreach ($links as $item)
            <li class="inline-flex items-center p-0">
                @if (isset($item['url']))
                    <a href="{{ $item['url'] }}">
                        {{ $item['name'] }}
                    </a>
                @else
                    <span class="text-gray-500">
                        {{ $item['name'] }}
                    </span>
                @endif
                @if (!$loop->last)
                    <svg class="w-auto h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
