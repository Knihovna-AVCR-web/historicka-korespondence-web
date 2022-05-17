@extends('layouts.app')

@section('content')
    <h1>
        {{ $title }}
    </h1>
    <hr>
    {{ the_content() }}
@endsection
