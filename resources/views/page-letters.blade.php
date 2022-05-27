@php
/*
* Template Name: Letters
*/
@endphp

@extends('layouts.wide')

@section('content')
    <div class="z-10 w-full px-6 mx-auto">
        <div class="w-full max-w-full mx-auto my-12 prose-sm prose sm:prose prose-stone sm:prose-stone prose-a:text-red-700">
            <x-breadcrumb />
            <h1>{!! the_title() !!}</h1>
        </div>
        @if (isset($error))
        <div class="prose-sm prose sm:prose prose-stone sm:prose-stone prose-a:text-red-700">
            <p>
                {{ $error }}
            </p>
            <p x-data>
                <a :href="window.location.href.split('?')[0]">
                    {{ __('Zpět k soupisu', 'hiko') }}
                </a>
            </p>
        </div>
        @elseif (isset($letter))
            @include('partials.letter', ['letter' => $letter])
        @else
        <div x-data="filterTable({ url: '{{ $searchUrl }}', ajaxUrl: '{{ admin_url('admin-ajax.php') . '/?action=read_json&url=' }}', el: $el })" x-init="submit()" class="flex flex-wrap mb-5" id="letters">
            @include('partials.letter-filters', ['searchUrl' => $searchUrl])
            @include('partials.letter-table')
        </div>
        @endif
    </div>
@endsection
