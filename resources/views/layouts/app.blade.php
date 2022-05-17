@include('partials.header')

<div class="z-10 w-full px-6 mx-auto max-w-7xl">
    <div class="mx-auto my-12 prose-sm prose sm:prose prose-stone sm:prose-stone prose-a:text-red-700">
        @yield('content')
    </div>
</div>

@include('partials.footer')
