@extends('layouts.wide')
@section('content')
    <img class="w-full" sizes="(max-width: 1400px) 100vw, 1400px" srcset="
            {{ \App\imageUrl('intro/main_bg_urfh37_c_scale,w_579.jpg') }} 579w,
            {{ \App\imageUrl('intro/main_bg_urfh37_c_scale,w_831.jpg') }} 831w,
            {{ \App\imageUrl('intro/main_bg_urfh37_c_scale,w_1041.jpg') }} 1041w,
            {{ \App\imageUrl('intro/main_bg_urfh37_c_scale,w_1221.jpg') }} 1221w,
            {{ \App\imageUrl('intro/main_bg_urfh37_c_scale,w_1537.jpg') }} 1537w,
            {{ \App\imageUrl('intro/main_bg_urfh37_c_scale,w_2057.jpg') }} 2057w,
            {{ \App\imageUrl('intro/main_bg_xezach_c_scale,w_2545.jpg') }} 2560w"
        src="{{ \App\imageUrl('intro/main_bg_xezach_c_scale,w_2545.jpg') }}" alt="" role="presentation" loading="lazy">
    <div class="px-5 py-12 bg-brown">
        <div class="max-w-4xl mx-auto text-xl italic text-center text-white">
            {!! $intro !!}
        </div>
    </div>
    <div class="container px-5 py-3 mx-auto mt-8">
        <h2 class="text-2xl"><?= __('Projekty', 'hiko') ?></h2>
        <div class="grid grid-cols-1 -mx-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach ($projects as $project)
                <a href=" {{ $project['link'] }}"
                    class="block p-3 m-2 text-sm transition-all duration-200 transform border-t border-b-2 border-l border-r border-gray-200 hover:shadow-md hover:border-opacity-0 hover:-translate-y-1">
                    <h3 class="mb-2 text-lg text-red-700 hover:text-red-900">
                        {{ $project['title'] }}
                    </h3>
                    <p class="transition-all duration-200 line-clamp-3">
                        {!! \App\nonbreakingSpaces($project['excerpt']) !!}
                    </p>
                </a>
            @endforeach
        </div>
    </div>
    <div class="container px-5 py-3 mx-auto text-primary">
        <div class="flex flex-wrap my-5 overflow-hidden md:-mx-5">
            {!! $boxes !!}
            @include('partials/intro-box', [
                'title' => __('Aktuálně', 'hiko'),
                'link' => get_category_link(get_cat_ID('Aktuálně')),
                'content' => view('partials.news', ['news' => $news])->render(),
            ])
        </div>
    </div>
    <div class="container flex flex-wrap justify-between px-5 mx-auto mt-24">
        <a href="https://lib.cas.cz" target="_blank">
            <img src="{{ \App\imageUrl('logo/knav.png') }}" alt="Knihovna AV ČR" class="m-2" loading="lazy"
                style="min-height:24px; min-width: 24px;">
        </a>
        <a href="http://www.avcr.cz/" target="_blank">
            <img src="{{ \App\imageUrl('logo/av.png') }}" alt="Akademie věd ČR" class="m-2" loading="lazy"
                style="min-height:24px; min-width: 24px;">
        </a>
        <a href="http://www.avcr.cz/cs/strategie/vyzkumne-programy/prehled-programu" target="_blank">
            <img src="{{ \App\imageUrl('logo/av21.png') }}" alt="Strategie AV21" class="m-2" loading="lazy"
                style="min-height:24px; min-width: 24px;">
        </a>
        <a href="https://www.mua.cas.cz/" target="_blank">
            <img src="{{ \App\imageUrl('logo/mua.png') }}" alt="Masyrykův ústav a archiv AV ČR" class="m-2"
                loading="lazy" style="min-height:24px; min-width: 24px;">
        </a>
        <a href="https://www.flu.cas.cz/" target="_blank">
            <img src="{{ \App\imageUrl('logo/ip.png') }}" alt="Filozofický ústav AV ČR" class="m-2"
                loading="lazy" style="min-height:24px; min-width: 24px;">
        </a>
    </div>
@endsection
