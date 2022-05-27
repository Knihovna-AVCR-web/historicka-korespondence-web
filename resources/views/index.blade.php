@extends('layouts.app')

@section('content')
<x-breadcrumb />
    <h1>
        {{ get_the_title() }}
    </h1>
    {{ the_content() }}
@endsection
