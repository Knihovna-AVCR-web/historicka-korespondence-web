@php
/*
* Template Name: Letters
*/
@endphp

@extends('layouts.wide')

@section('content')
    <div class="z-10 w-full px-6 mx-auto">
        <div class="mx-auto my-12 prose-sm prose sm:prose prose-stone sm:prose-stone prose-a:text-red-700 w-full max-w-full">
            <x-breadcrumb />
            <h1>{!! the_title() !!}</h1>
        </div>
    </div>
@endsection
