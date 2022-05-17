@extends('layouts.front')
@section('content')
    <div class="w-full px-6 mx-auto max-w-7xl">
        <article class="mx-auto prose-sm sm:prose">
            {{ the_content() }}
        </article>
    </div>
@endsection
