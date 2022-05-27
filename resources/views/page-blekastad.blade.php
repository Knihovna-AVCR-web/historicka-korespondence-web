@php
/*
* Template Name: Blekastad Front Page
*/
@endphp

@extends('layouts.wide')

@section('content')
    <div class="relative">
        <img class="w-full" sizes="(max-width: 2560px) 100vw, 2560px" srcset="
        {{ \App\imageUrl('intro/blekastad_bg_hgwpso_c_scale,w_525.jpg') }} 525w,
        {{ \App\imageUrl('intro/blekastad_bg_hgwpso_c_scale,w_747.jpg') }} 747w,
        {{ \App\imageUrl('intro/blekastad_bg_hgwpso_c_scale,w_936.jpg') }} 936w,
        {{ \App\imageUrl('intro/blekastad_bg_hgwpso_c_scale,w_1099.jpg') }} 1099w,
        {{ \App\imageUrl('intro/blekastad_bg_hgwpso_c_scale,w_1245.jpg') }} 1245w,
        {{ \App\imageUrl('intro/blekastad_bg_hgwpso_c_scale,w_1524.jpg') }} 1524w,
        {{ \App\imageUrl('intro/blekastad_bg_hgwpso_c_scale,w_2010.jpg') }} 2010w,
        {{ \App\imageUrl('intro/blekastad_bg_hgwpso_c_scale,w_2560.jpg') }} 2560w"
            src="{{ \App\imageUrl('intro/blekastad_bg_hgwpso_c_scale,w_2560.jpg') }}" alt="" role="presentation">
        <a href="{{ $dbUrl }}"
            class="absolute px-6 py-2 text-xl text-white uppercase duration-150 transform -translate-x-1/2 -translate-y-1/2 bg-red-700 border border-red-700 rounded-sm opacity-75 top-1/2 left-1/2 hover:opacity-80">
            {{ __('Vstup do databáze', 'hiko') }}&nbsp;&nbsp;&raquo;
        </a>
    </div>
    <div class="container mx-auto mt-12">
        <p class="w-64 pl-4 font-bold border-l-4 border-opacity-50 border-brown ">
            <span class="block mb-1 text-2xl">
                {{ __('Korespondence', 'hiko') }}
            </span>
            <span class="text-4xl italic leading-tight text-red-700">
                {{ __('Milady Blekastad', 'hiko') }}
            </span>
        </p>
    </div>
@endsection
