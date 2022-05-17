@extends('layouts.app')

@section('content')
    @if (has_post_thumbnail())
        {{ the_post_thumbnail() }}
    @endif
    <article>
        <h1>
            {{ the_title() }}
        </h1>
        <p class="text-sm">
            {{ get_the_date() }}
        </p>
        <hr>
        {{ the_content() }}
    </article>
@endsection
