@extends('layouts.app')

@section('content')
    <h1>
        {{ __('Výsledky vyhledávání pro:', 'hiko') }} {{ get_search_query() }}
    </h1>
    @if (have_posts())
        <p>
            {{ __('Počet výsledků', 'hiko') }}: {{ $GLOBALS['wp_query']->found_posts }}
        </p>
        <ul>
            @while (have_posts())
                @php(the_post())
                <li>
                    <a href="{{ the_permalink() }}">
                        {{ the_title() }}
                    </a>
                </li>
            @endwhile
        </ul>
    @else
        <p>
            {{ __('Zadaný výraz nebyl nalezen. Zkuste to znovu.', 'hiko') }}
        </p>
        @include('partials.search')
    @endif
@endsection
