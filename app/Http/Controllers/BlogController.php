<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $posts = Post::where('title', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%")
                    ->get();

        return view('blog.search_results', ['posts' => $posts]);
    }
}
