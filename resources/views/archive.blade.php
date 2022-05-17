@extends('layouts.app')

@section('content')
    <h1>
        {{ $title}}
    </h1>
    <hr>
        <ul>
            @while (have_posts())
                @php(the_post())
                <li>
                    <a href="{{ the_permalink() }}">{{ the_title() }}</a>
                </li>
            @endwhile
        </ul>
@endsection
