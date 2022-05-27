@if (!empty($links))
    <ul class="flex flex-wrap p-0 space-x-4 list-none">
        @foreach ($links as $link)
            {!! $link !!}
        @endforeach
    </ul>
@endif
