@extends('layouts.app')

@section('content')
    <h1>
        {{ $title }}
    </h1>
    <hr>
    @if (have_posts())
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
            {{ __('Zadaný výraz nebyl nalezen. Zkuste to znovu.', 'ilustory') }}
        </p>
        @include('partials.search')
    @endif
@endsection
