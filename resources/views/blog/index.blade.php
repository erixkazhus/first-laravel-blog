@extends('layouts.app')

@section('content')
    <div class="w-4/5 m-auto text-center">
        <div class="py-15 border-b border-gray-200">
            <h1 class="text-6xl">
                Blog Posts
            </h1>
        </div>
    </div>
    @if (session()->has('message'))
        <div class="w-4/5 m-auto mt-10 pl-2">
            <p class="w-2/6 mb-4 text-gray-50 bg-green-500 rounded-2xl py-4 text-center center">
                {{ session()->get('message') }}
            </p>
        </div>
    @endif
    @if (Auth::check())
        <div class="pt-15 w-4/5 m-auto">
            <a href="/blog/create" class="bg-blue-500 uppercase bg-transparent text-gray-100 text-xs font-extra-bold py-3 px-5 rounded-3xl">
                Create post
            </a>
        </div>
    @endif
    @foreach ($posts as $post)
        <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
            <div>
                <img src="{{ asset('images/' . $post->image_path) }}" alt="">
            </div>
            <div>
                <h2 class="text-gray-700 font-bold text-5xl pb-4">
                    {{$post->title}}
                </h2>
                <span class="text-gray-500">
                    By <span class="font-bold italic text-gray-800">{{$post->user->name}}</span>, Created on {{date('jS M Y', strtotime($post->updated_at))}}
                </span>
                <p class="text-gray-700">Categories:@foreach($post->categories as $category)
                        <span class="text-sm px-2 py-1 rounded">{{ $category->name }}</span>
                    @endforeach
                </p>
                <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
                    {{$post->description}}
                </p>
                <a href="/blog/{{ $post->slug }}" class="uppercase bg-blue-500 text-gray-100 text-lg font-extra-bold py-4 px-8 rounded-3xl">
                    Keep reading
                </a>
                @if (Auth::check() && Auth::id() == $post->user_id)
                    <span class="float-right">
                        <a href="/blog/{{ $post->slug }}/edit" class="text-gray-700 italic hover:text-gray-900 pb-1 border-b-2">Edit Post</a>
                    </span>
                    <span class="float-right">
                        <form action="/blog/{{ $post->slug }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="text-red-500 pr-3" type="submit">Delete Post</button>
                        </form>
                    </span>
                @endif
                <!-- Comments Section -->
                <div class="w-4/5 m-auto pt-10">
                    <h2 class="text-4xl pb-4">Comments</h2>
                    @if($post->comments->isEmpty() && !session()->has('new_comment'))
                        <p class="text-gray-500">No comments yet.</p>
                    @else
                        @if (session()->has('new_comment') && $post->id == session('new_comment')->post_id)
                            <div class="bg-gray-100 p-4 mb-4 rounded-lg">
                                <span class="font-bold text-gray-800">{{ session('new_comment')->user->name }}</span>
                                <span class="text-gray-500">{{ date('jS M Y, H:i', strtotime(session('new_comment')->created_at)) }}</span>
                                <p class="text-gray-700 pt-2">{{ session('new_comment')->content }}</p>
                            </div>
                        @endif
                        @foreach($post->comments as $comment)
                            <div class="bg-gray-100 p-4 mb-4 rounded-lg">
                                <span class="font-bold text-gray-800">{{ $comment->user->name }}</span>
                                <span class="text-gray-500">{{ date('jS M Y, H:i', strtotime($comment->created_at)) }}</span>
                                <p class="text-gray-700 pt-2">{{ $comment->content }}</p>
                                @if(Auth::check() && Auth::id() == $comment->user_id)
                                    <form action="{{ route('comments.destroy', [$post->slug, $comment->id]) }}" method="POST" class="float-right">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="view" value="index">
                                        <button type="submit" class="text-red-500">Delete Comment</button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    @endif
                    @if(Auth::check())
                    <div class="pt-10">
                        <form action="{{ route('comments.store', $post->slug) }}" method="POST">
                            @csrf
                            <input type="hidden" name="view" value="index">
                            <textarea name="content" rows="4" class="w-full p-2 border border-gray-300 rounded" placeholder="Add your comment..."></textarea>
                            @error('content')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded mt-2">Add Comment</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
@endsection
