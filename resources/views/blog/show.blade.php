@extends('layouts.app')

@section('content')
    <div class="w-4/5 m-auto text-left">
        <div class="py-15">
            <h1 class="text-6xl">{{ $post->title }}</h1>
        </div>
    </div>
    <div>
        <img src="{{ asset('images/' . $post->image_path) }}" alt="" style="max-width: 10%; height: 20%;  margin-left: 150px; ">
    </div>
    <!-- Shows post -->
    <div class="w-4/5 m-auto pt-20">
        <span class="text-gray-500">
            By <span class="font-bold italic text-gray-800">{{ $post->user->name }}</span>, Created on {{ date('jS M Y', strtotime($post->updated_at)) }}
        </span>
        <p class="text-gray-700">Categories: 
            @foreach($post->categories as $category)
                <span class="text-sm px-2 py-1 rounded">{{ $category->name }}</span>
            @endforeach
        </p>
        <p class="text-xl text-gray-700 pt-2 pb-2 leading-8 font-light border border-gray-300 bg-white p-4 rounded-md shadow-sm">
            {{ $post->description }}
        </p>
    </div>
    <!-- Comments Section -->
    <div class="w-4/5 m-auto pt-10">
        <h2 class="text-4xl pb-4">Comments</h2>
        @if($post->comments->isEmpty())
            <p class="text-gray-500">No comments yet.</p>
        @else
            @foreach($post->comments as $comment)
                <div class="bg-gray-100 p-4 mb-4 rounded-lg">
                    <span class="font-bold text-gray-800">{{ $comment->user->name }}</span>
                    <span class="text-gray-500">{{ date('jS M Y, H:i', strtotime($comment->created_at)) }}</span>
                    <p class="text-gray-700 pt-2">{{ $comment->content }}</p>
                    <!-- Delete Comment Form -->
                    @if(Auth::check() && Auth::id() == $comment->user_id)
                        <form action="{{ route('comments.destroy', [$post->slug, $comment->id]) }}" method="POST" class="float-right">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="view" value="show">
                            <button type="submit" class="text-red-500">
                                Delete
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        @endif
        <!-- Add Comment Form -->
        @if(Auth::check())
            <div class="pt-10">
                <form action="{{ route('comments.store', $post->slug) }}" method="POST">
                    @csrf
                    <input type="hidden" name="view" value="show">
                    <textarea name="content" rows="4" class="w-full p-2 border border-gray-300 rounded" placeholder="Add your comment..."></textarea>
                    @error('content')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded mt-2">Add Comment</button>
                </form>
            </div>
        @endif
    </div>
@endsection
