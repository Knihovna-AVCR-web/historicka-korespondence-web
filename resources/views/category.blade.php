@extends('layouts.app')

@section('content')
    <x-breadcrumb />
    <h1>
        {{ single_cat_title() }}
    </h1>
    @while (have_posts())
        @php(the_post())
        <article>
            <h2>
                <a href="{{ get_permalink() }}">
                    {{ get_the_title() }}
                </a>
            </h2>
            <p class="text-sm">
                <?php the_date(); ?>
            </p>
            {{ the_excerpt() }}
        </article>
    @endwhile
    <div class="mt-24">
        <x-pagination />
    </div>
@endsection
