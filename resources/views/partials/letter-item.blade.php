{{ $item['name'] }}
@if (!empty($item['marked']) && $item['marked'] != $item['name'])
    <span class="block pl-4 text-gray-500">Marked as: {{ $item['marked'] }}</span>
@endif

@if (isset($item['salutation']) && !empty($item['salutation']))
    <span class="block pl-4 text-gray-500">Salutation: {{ $item['salutation'] }}</span>
@endif
