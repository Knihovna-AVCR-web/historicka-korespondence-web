@foreach ($news as $item)
    <h3>
        <a href="{{ $item['link'] }}" class="text-primary">
            {{ $item['title'] }}
            <span class="text-sm">
                ({{ $item['date'] }})
            </span>
        </a>
    </h3>
@endforeach
