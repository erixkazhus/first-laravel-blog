@extends('layouts.app')

@section('content')
    <div class="w-4/5 m-auto text-left">
        <div class="py-15">
            <h1 class="text-6xl">
                Search Results
            </h1>
        </div>
        @if ($posts->isEmpty())
            <p>No results found for your query.</p>
        @else
            <div class="py-10">
                @foreach ($posts as $post)
                    <div class="mb-6">
                        <h2 class="text-4xl font-bold">
                            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                        </h2>
                        <p><img src="{{ asset('images/' . $post->image_path) }}" alt="" style="max-width: 10%; height: 20%;  margin-left: 10px; "></p>
                        <p class="text-xl">{{ \Str::limit($post->description, 150) }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
