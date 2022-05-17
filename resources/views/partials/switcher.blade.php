<span class="divide-x divide-gray-600">
    @foreach ($languages as $language)
        <a href="{{ $language['disabled'] ? '' : $language['url'] }}"
            class="uppercase text-sm px-2 {{ $language['disabled'] ? 'text-gray-400 hover:text-gray-400' : 'hover:text-red-700' }}">
            {{ $language['name'] }}
        </a>
    @endforeach
</span>
