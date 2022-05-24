<div class="flex flex-wrap mx-auto mt-12 mb-5">
    <div x-data id="letters-filter" class="w-full mb-5 md:w-3/12 md:pr-6">
        <a :href="window.location.href.split('?')[0]" class="mb-3 text-3xl text-red-700">
            {{ __('Zpět k soupisu', 'hiko') }}
        </a>
    </div>
    <div class="w-full md:w-9/12">
        <h1 class="mb-6 text-3xl">
            {{ $letter['name'] }}
        </h1>
        <h2 class="text-lg font-bold">Dates</h2>
        <table class="w-full mb-10 text-sm">
            <tbody>
                <tr class="align-baseline border-t border-b border-gray-200">
                    <td class="w-1/5 py-2">
                        Letter date
                    </td>
                    <td class="py-2">
                        {{ $letter['dates']['date'] }} @if ($letter['dates']['date_range'])
                            - {{ $letter['dates']['date_range'] }}
                        @endif
                        @if ($letter['dates']['date_uncertain'])
                            <small class="block"><em>Uncertain date</em></small>
                        @endif
                        @if ($letter['dates']['date_inferred'])
                            <small class="block"><em>Inferred date</em></small>
                        @endif
                        @if ($letter['dates']['date_approximate'])
                            <small class="block"><em>Approximate date</em></small>
                        @endif
                    </td>
                </tr>
                @if ($letter['dates']['date_marked'])
                    <tr class="align-baseline border-t border-b border-gray-200">
                        <td class="py-2">
                            Date as marked
                        </td>
                        <td class="py-2">
                            {{ $letter['dates']['date_marked'] }}
                        </td>
                    </tr>
                @endif
                @if ($letter['dates']['date_note'])
                    <tr class="align-baseline border-t border-b border-gray-200">
                        <td class="py-2">
                            Notes on date
                        </td>
                        <td class="py-2">
                            {{ $letter['dates']['date_note'] }}
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <h2 class="text-lg font-bold">People</h2>
        <table class="w-full mb-10 text-sm">
            <tbody>
                @if (!empty($letter['authors']['items']))
                    <tr class="align-baseline border-t border-b border-gray-200">
                        <td class="w-1/5 py-2">
                            Author
                        </td>
                        <td class="py-2">
                            <ul class="list-disc list-inside">
                                @foreach ($letter['authors']['items'] as $author)
                                    <li class="mb-1">
                                        @include('partials.letter-item', ['item' => $author])
                                    </li>
                                @endforeach
                            </ul>
                            @if ($letter['authors']['uncertain'])
                                <small class="block pl-4"><em>Uncertain author</em></small>
                            @endif
                            @if ($letter['authors']['inferred'])
                                <small class="block pl-4"><em>Inferred author</em></small>
                            @endif
                        </td>
                    </tr>
                @endif
                @if ($letter['authors']['note'])
                    <tr class="align-baseline border-t border-b border-gray-200">
                        <td class="py-2">
                            Notes on author
                        </td>
                        <td class="py-2">
                            {{ $letter['authors']['note'] }}
                        </td>
                    </tr>
                @endif
                @if (!empty($letter['recipients']['items']))
                    <tr class="align-baseline border-t border-b border-gray-200">
                        <td class="w-1/5 py-2">
                            Recipient
                        </td>
                        <td class="py-2">
                            <ul class="list-disc list-inside">
                                @foreach ($letter['recipients']['items'] as $recipient)
                                    <li class="mb-1">
                                        @include('partials.letter-item', ['item' => $recipient])
                                    </li>
                                @endforeach
                            </ul>
                            @if ($letter['recipients']['uncertain'])
                                <small class="block pl-4"><em>Uncertain recipient</em></small>
                            @endif
                            @if ($letter['recipients']['inferred'])
                                <small class="block pl-4"><em>Inferred recipient</em></small>
                            @endif
                        </td>
                    </tr>
                @endif
                @if ($letter['recipients']['note'])
                    <tr class="align-baseline border-t border-b border-gray-200">
                        <td class="py-2">
                            Notes on recipient
                        </td>
                        <td class="py-2">
                            {{ $letter['recipients']['note'] }}
                        </td>
                    </tr>
                @endif
                @if (!empty($letter['mentioned']['items']))
                    <tr class="align-baseline border-t border-b border-gray-200">
                        <td class="w-1/5 py-2">
                            Mentioned people
                        </td>
                        <td class="py-2">
                            <ul class="list-disc list-inside">
                                @foreach ($letter['mentioned']['items'] as $mentioned)
                                    <li class="mb-1">
                                        {{ $mentioned }}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endif
                @if ($letter['mentioned']['note'])
                    <tr class="align-baseline border-t border-b border-gray-200">
                        <td class="py-2">
                            Notes on mentioned people
                        </td>
                        <td class="py-2">
                            {{ $letter['mentioned']['note'] }}
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <h2 class="text-lg font-bold">Places</h2>
        <table class="w-full mb-10 text-sm">
            <tbody>
                @if (!empty($letter['origins']['items']))
                    <tr class="align-baseline border-t border-b border-gray-200">
                        <td class="w-1/5 py-2">Origin</td>
                        <td class="py-2">
                            <ul class="list-disc list-inside">
                                @foreach ($letter['origins']['items'] as $origin)
                                    <li class="mb-1">
                                        @include('partials.letter-item', ['item' => $origin])
                                    </li>
                                @endforeach
                            </ul>
                            @if ($letter['origins']['uncertain'])
                                <small class="block pl-4"><em>Uncertain origin</em></small>
                            @endif
                            @if ($letter['origins']['inferred'])
                                <small class="block pl-4"><em>Inferred origin</em></small>
                            @endif
                        </td>
                    </tr>
                @endif
                @if ($letter['origins']['note'])
                    <tr class="align-baseline border-t border-b border-gray-200">
                        <td class="py-2">
                            Notes on origin
                        </td>
                        <td class="py-2">
                            {{ $letter['origins']['note'] }}
                        </td>
                    </tr>
                @endif
                @if (!empty($letter['destinations']['items']))
                    <tr class="align-baseline border-t border-b border-gray-200">
                        <td class="w-1/5 py-2">Destination</td>
                        <td class="py-2">
                            <ul class="list-disc list-inside">
                                @foreach ($letter['destinations']['items'] as $destination)
                                    <li class="mb-1">
                                        @include('partials.letter-item', ['item' => $destination])
                                    </li>
                                @endforeach
                            </ul>
                            @if ($letter['destinations']['uncertain'])
                                <small class="block pl-4"><em>Uncertain destination</em></small>
                            @endif
                            @if ($letter['destinations']['inferred'])
                                <small class="block pl-4"><em>Inferred destination</em></small>
                            @endif
                        </td>
                    </tr>
                @endif
                @if ($letter['destinations']['note'])
                    <tr class="align-baseline border-t border-b border-gray-200">
                        <td class="py-2">
                            Notes on destination
                        </td>
                        <td class="py-2">
                            {{ $letter['destinations']['note'] }}
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <h2 class="text-lg font-bold">Content</h2>
        <table class="w-full mb-10 text-sm">
            <tbody>
                @isset($letter['abstract']['cs'])
                    <tr class="align-baseline border-t border-b border-gray-200">
                        <td class="w-1/5 py-2">Abstract CS</td>
                        <td class="py-2">{{ $letter['abstract']['cs'] }}</td>
                    </tr>
                @endisset
                @isset($letter['abstract']['en'])
                    <tr class="align-baseline border-t border-b border-gray-200">
                        <td class="w-1/5 py-2">Abstract EN</td>
                        <td class="py-2">{{ $letter['abstract']['en'] }}</td>
                    </tr>
                @endisset
                @if ($letter['incipit'])
                    <tr class="align-baseline border-t border-b border-gray-200">
                        <td class="w-1/5 py-2">Incipit</td>
                        <td class="py-2">{{ $letter['incipit'] }}</td>
                    </tr>
                @endif
                @if ($letter['explicit'])
                    <tr class="align-baseline border-t border-b border-gray-200">
                        <td class="w-1/5 py-2">Explicit</td>
                        <td class="py-2">{{ $letter['explicit'] }}</td>
                    </tr>
                @endif
                @if (!empty($letter['languages']))
                    <tr class="align-baseline border-t border-b border-gray-200">
                        <td class="w-1/5 py-2">Languages</td>
                        <td class="py-2">
                            <ul class="list-disc list-inside">
                                @foreach ($letter['languages'] as $language)
                                    <li class="mb-1">
                                        {{ $language }}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endif
                @if (!empty($letter['keywords']))
                    <tr class="align-baseline border-t border-b border-gray-200">
                        <td class="w-1/5 py-2">Keywords</td>
                        <td class="py-2">
                            <ul class="list-disc list-inside">
                                @foreach ($letter['keywords'] as $keyword)
                                    <li class="mb-1">
                                        {{ implode(' | ', array_values($keyword)) }}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endif
                @if ($letter['note'])
                    <tr class="align-baseline border-t border-b border-gray-200">
                        <td class="w-1/5 py-2">Notes on letter</td>
                        <td class="py-2">{{ $letter['note'] }}</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <h2 class="text-lg font-bold">
            Repositories and versions
        </h2>
        @foreach ($letter['copies'] as $c)
            <table class="w-full mb-10 text-sm">
                <tbody>
                    @if (isset($c['l_number']) && $c['l_number'])
                        <tr class="align-baseline border-t border-b border-gray-200">
                            <td class="w-1/5 py-2">Letter number</td>
                            <td class="py-2">{{ $c['l_number'] }}</td>
                        </tr>
                    @endif
                    @if (isset($c['repository']) && $c['repository'])
                        <tr class="align-baseline border-t border-b border-gray-200">
                            <td class="w-1/5 py-2">Repository</td>
                            <td class="py-2">{{ $c['repository'] }}</td>
                        </tr>
                    @endif
                    @if (isset($c['archive']) && $c['archive'])
                        <tr class="align-baseline border-t border-b border-gray-200">
                            <td class="w-1/5 py-2">Archive</td>
                            <td class="py-2">{{ $c['archive'] }}</td>
                        </tr>
                    @endif
                    @if (isset($c['collection']) && $c['collection'])
                        <tr class="align-baseline border-t border-b border-gray-200">
                            <td class="w-1/5 py-2">Collection</td>
                            <td class="py-2">{{ $c['collection'] }}</td>
                        </tr>
                    @endif
                    @if (isset($c['signature']) && $c['signature'])
                        <tr class="align-baseline border-t border-b border-gray-200">
                            <td class="w-1/5 py-2">Signature</td>
                            <td class="py-2">{{ $c['signature'] }}</td>
                        </tr>
                    @endif
                    @if (isset($c['location_note']) && $c['location_note'])
                        <tr class="align-baseline border-t border-b border-gray-200">
                            <td class="w-1/5 py-2">Note on location</td>
                            <td class="py-2">{{ $c['location_note'] }}</td>
                        </tr>
                    @endif
                    @if (isset($c['type']) && $c['type'])
                        <tr class="align-baseline border-t border-b border-gray-200">
                            <td class="w-1/5 py-2">Document type</td>
                            <td class="py-2">{{ $c['type'] }}</td>
                        </tr>
                    @endif
                    @if (isset($c['preservation']) && $c['preservation'])
                        <tr class="align-baseline border-t border-b border-gray-200">
                            <td class="w-1/5 py-2">Preservation</td>
                            <td class="py-2">{{ $c['preservation'] }}</td>
                        </tr>
                    @endif
                    @if (isset($c['copy']) && $c['copy'])
                        <tr class="align-baseline border-t border-b border-gray-200">
                            <td class="w-1/5 py-2">Type of copy</td>
                            <td class="py-2">{{ $c['copy'] }}</td>
                        </tr>
                    @endif
                    @if (isset($c['manifestation_notes']) && $c['manifestation_notes'])
                        <tr class="align-baseline border-t border-b border-gray-200">
                            <td class="w-1/5 py-2">Notes on manifestation</td>
                            <td class="py-2">{{ $c['manifestation_notes'] }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        @endforeach
        @if (!empty($letter['related_resources']))
            <h2 class="text-lg font-bold">Related resources</h2>
            <table class="w-full mb-10 text-sm">
                <tbody>
                    @if ($letter['copyright'])
                        <tr class="align-baseline border-t border-b border-gray-200">
                            <td class="w-1/5 py-2">Copyright</td>
                            <td class="py-2">{{ $letter['copyright'] }}</td>
                        </tr>
                    @endif
                    <tr class="align-baseline border-t border-b border-gray-200">
                        <td class="py-2">
                            <ul class="list-disc list-inside max-w-prose">
                                @foreach ($letter['related_resources'] as $resource)
                                    <li class="mb-1">
                                        @if (!empty($resource['link']))
                                            <a href="{{ $resource['link'] }}" target="_blank"
                                                class="no-underline hover:underline">
                                                {{ $resource['title'] }}
                                            </a>
                                        @else
                                            {{ $resource['title'] }}
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        @endif
        @isset($letter['media'])
            <div class="flex flex-wrap mb-6 -m-x-1 gallery">
                @foreach ($letter['media'] as $media)
                    <a href="{{ $media['full'] }}" data-caption="{{ $media['description'] }}">
                        <img src="{{ $media['thumb'] }}" class="w-32 h-auto m-1 shadow"
                            alt="{{ $media['description'] }}" loading="lazy">
                    </a>
                @endforeach
            </div>
        @endisset
    </div>
</div>
