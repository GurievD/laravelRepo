<?php

use App\Http\Controllers\ActorCommentController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\GreetingController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MovieCommentController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [SiteController::class, 'index'])
    ->name('index');

Route::get('about', [SiteController::class, 'about'])
    ->name('about');

Route::get('greeting/hello', [GreetingController::class, 'hello'])
    ->name('greeting.hello');

Route::get('/movies_search', [MovieController::class, 'search'])->name('movie.search');

Route::get('/actors_search', [ActorController::class, 'search'])->name('actor.search');



Route::middleware('auth')
    ->group(function () {
        Route::resource('categories', CategoryController::class)
            ->except('index');

        Route::resource('posts', PostController::class)
            ->except('index', 'show');

        Route::resource('genres', GenreController::class);

        Route::resource('movies', MovieController::class)->except('index', 'show');

        Route::resource('actors', ActorController::class)->except('index', 'show');

        Route::put('posts/{post}/like', [LikeController::class, 'toggle'])
            ->name('likes.toggle');

        Route::put('movies/{movie}/like', [LikeController::class, 'movie_toggle'])
            ->name('movie_likes.toggle');

        Route::put('actors/{actor}/like', [LikeController::class, 'actor_toggle'])
            ->name('actor_likes.toggle');


        Route::post('movie/{movie}/comment',[MovieCommentController::class, 'store'])
            ->name('movie_comment.create');

        Route::post('/movie_comment/delete/{comment}',[MovieCommentController::class, 'destroy'])
            ->name('movie_comment.delete');

        Route::post('actor/{actor}/comment',[ActorCommentController::class, 'store'])
            ->name('actor_comment.create');

        Route::post('/actor_comment/delete/{comment}',[ActorCommentController::class, 'destroy'])
            ->name('actor_comment.delete');

        Route::post('post/{post}/comment',[CommentController::class, 'store'])
            ->name('comment.create');

        Route::post('/comment/delete/{comment}',[CommentController::class, 'destroy'])
            ->name('comment.delete');


    });

Route::resource('posts', PostController::class)
    ->only('index', 'show');
Route::resource('movies', MovieController::class)
    ->only('index', 'show');
Route::resource('actors', ActorController::class)
    ->only('index', 'show');

Route::get('users/{user}/categories', [CategoryController::class, 'index'])
    ->name('categories.index');
Route::get('users/{user}/posts', [PostController::class, 'byUser'])
    ->name('user.posts');
Route::get('categories/{category}/posts', [PostController::class, 'byCategory'])
    ->name('category.posts');
Route::get('genres/{genre}/movies', [MovieController::class, 'byGenre'])
    ->name('genre.movies');
Route::get('actors/{actor}/movies', [MovieController::class, 'byActor'])
    ->name('actor.movies');







//Route::get('categories/create', [CategoryController::class, 'create'])
//    ->name('categories.create');
//
//Route::post('categories', [CategoryController::class, 'store'])
//    ->name('categories.store');
//
//Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])
//    ->name('categories.edit');
//
//Route::put('categories/{category}', [CategoryController::class, 'update'])
//    ->name('categories.update');
//
//Route::delete('categories/{category}', [CategoryController::class, 'destroy'])
//    ->name('categories.destroy');
