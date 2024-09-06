<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Auth;

class CommentsController extends Controller
{
    public function store(Request $request, $slug)
{
    $request->validate([
        'content' => 'required|min:5|max:1000',
    ]);

    $post = Post::where('slug', $slug)->firstOrFail();

    Comment::create([
        'content' => $request->input('content'),
        'user_id' => Auth::id(),
        'post_id' => $post->id,
    ]);
    
    $view = $request->input('view', 'index');

    if ($view === 'show') {
        return redirect()->route('blog.show', $slug)->with('message', 'Comment added successfully');
    }

    return redirect()->route('blog.index')->with('message', 'Comment added successfully');
}

public function destroy(Request $request, $slug, $commentId)
{
    $post = Post::where('slug', $slug)->firstOrFail();
    $comment = Comment::where('id', $commentId)->where('post_id', $post->id)->firstOrFail();

    if (Auth::id() !== $comment->user_id) {
        return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
    }

    $comment->delete();
    
    $view = $request->input('view', 'index');

    if ($view === 'show') {
        return redirect()->route('blog.show', $slug)->with('message', 'Comment deleted successfully.');
    }

    return redirect()->route('blog.index')->with('message', 'Comment deleted successfully.');
}

}
