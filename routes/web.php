<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GreetingController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [SiteController::class, 'index'])
    ->name('index');

Route::get('about', [SiteController::class, 'about'])
    ->name('about');

Route::get('greeting/hello/{name}', [GreetingController::class, 'hello'])
    ->name('greeting.hello');

Route::middleware('auth')
    ->group(function () {
        Route::resource('categories', CategoryController::class)
            ->except('index');

        Route::resource('posts', PostController::class)
            ->except('index', 'show');
    });

Route::get('users/{user}/categories', [CategoryController::class, 'index'])
    ->name('categories.index');

Route::resource('posts', PostController::class)
    ->only('index', 'show');


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
