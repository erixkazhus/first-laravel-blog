<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Routing\Redirector;
use App\Models\Category;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('blog.index')
            ->with('posts', Post::orderBy('updated_at', 'DESC')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('blog.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $newImageName = uniqid() . '-' . $request->title . '-' . $request->image->extension();

        $request->image->move(public_path('images'), $newImageName);

        try {
            $post = Post::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
                'image_path' => $newImageName,
                'user_id' => auth()->id(),
            ]);

            $post->categories()->attach($request->input('categories'));


            return redirect('/blog')
                ->with('message', 'Your post has been added!');
        } catch (\Exception $e) {
                return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return Application|Factory|View
     */
    public function show($slug)
    {
           $post = Post::where('slug', $slug)->with('comments.user')->firstOrFail();
           return view('blog.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $slug
     * @return Application|Factory|View
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        return view('blog.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  string  $slug
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);
        $post = Post::where('slug', $slug)->firstOrFail();
            $post->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),

                'user_id' => auth()->user()->id
            ]);
            $post->categories()->sync($request->input('categories'));
            return redirect('/blog')
                ->with('message', 'Your post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($slug)
    {
        $post = Post::where('slug', $slug);
        $post->delete();

        return redirect('/blog')
                ->with('message', 'Your post has been deleted!');
    }
    
}



