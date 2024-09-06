@extends('layouts.app')

@section('content')
<div class="w-4/5 m-auto pt-20">
    <h1 class="text-3xl font-bold pb-10">Add a Comment</h1>
    <form action="/blog/{{ $post->slug }}/comments" method="POST">
        @csrf
        <textarea name="content" rows="5" class="w-full border-2 p-3" placeholder="Your comment..."></textarea>
        <button type="submit" class="mt-3 bg-blue-500 text-white px-4 py-2 rounded">Submit Comment</button>
    </form>
</div>
@endsection
