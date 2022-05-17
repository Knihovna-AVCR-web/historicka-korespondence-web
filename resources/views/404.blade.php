@extends('layouts.app')

@section('content')
    <article>
        <h1>
            {{ $title }}
        </h1>
        <hr>
        <p>
            {{ __('Zadaná stránka nebyla nalezena.', 'hiko') }}
        </p>
        @include('partials.search')
    </article>
@endsection
