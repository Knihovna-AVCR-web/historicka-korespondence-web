<article class="w-full my-4 md:px-5 md:w-6/12 xl:w-4/12 front">
    <h2 class="mb-3 text-2xl border-b-2">
        <a href="{{ $link }}">
            {!! $title !!}
        </a>
    </h2>
    <div class="text-sm prose text-primary">
        {!! \App\nonbreakingSpaces($content) !!}
    </div>
</article>
