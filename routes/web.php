<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [PagesController::class, 'index']);
//Route::resource('/blog', [PostsController::class, 'index']);
Route::get('/blog', [PostsController::class, 'index']);
Route::get('/blog/create', [PostsController::class, 'create']);
Route::POST('/blog/create', [PostsController::class, 'store']);
Route::get('/blog/{slug}', [PostsController::class, 'show']);
Route::get('/blog/{slug}/edit', [PostsController::class, 'edit']);
Route::PUT('/blog/{slug}', [PostsController::class, 'update']);
Route::delete('/blog/{slug}', [PostsController::class, 'destroy']);


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');



