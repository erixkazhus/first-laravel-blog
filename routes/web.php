<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;

define('BLOG_SLUG_PATH', '/blog/{slug}');

Route::get('/', [PagesController::class, 'index'])->name('home');

// Blog post routes
Route::get('/blog', [PostsController::class, 'index'])->name('blog.index');
Route::get('/blog/create', [PostsController::class, 'create']);
Route::post('/blog/create', [PostsController::class, 'store']);

Route::get(BLOG_SLUG_PATH, [PostsController::class, 'show'])->name('blog.show');
Route::get(BLOG_SLUG_PATH . '/edit', [PostsController::class, 'edit']);
Route::put(BLOG_SLUG_PATH, [PostsController::class, 'update']);
Route::delete(BLOG_SLUG_PATH, [PostsController::class, 'destroy']);

// Comment routes
Route::post(BLOG_SLUG_PATH . '/comments', [CommentsController::class, 'store'])->name('comments.store');
Route::delete(BLOG_SLUG_PATH . '/comments/{commentId}', [CommentsController::class, 'destroy'])->name('comments.destroy');
Route::get('/search', [BlogController::class, 'search'])->name('search');

// Authentication routes
Auth::routes();

// Home route for authenticated users
Route::get('/home', [HomeController::class, 'index'])->name('home');
