@extends('layouts.app')

@section('content')
    <x-breadcrumb />
    <article>
        <h1>
            {!! the_title() !!}
        </h1>
        <p class="text-sm">
            {{ get_the_date() }}
        </p>
        {{ the_content() }}
    </article>
@endsection
