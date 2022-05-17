@extends('layouts.app')

@section('content')
    <article>
        <h1>
            {{ __('Nenalezeno', 'hiko') }}
        </h1>
        <p>
            {{ __('Zadaná stránka nebyla nalezena.', 'hiko') }}
        </p>
        @include('partials.search')
    </article>
@endsection
