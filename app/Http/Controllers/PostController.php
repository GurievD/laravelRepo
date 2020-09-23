<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFormRequest;
use App\Models\Post;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::query()
            ->latest()
            ->paginate(3);

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function create()
    {
        $this->authorize('create', Post::class);



        return view('posts.form', [
            'categories' => auth()->user()->categories
        ]);
    }

    public function store(PostFormRequest $request)
    {
        $this->authorize('create', Post::class);

        $post = auth()->user()
            ->posts()
            ->create($request->validated());


        return redirect()->route('posts.show', $post);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.form', [
            'post' => $post,
            'categories' => auth()->user()->categories
        ]);
    }

    public function update(PostFormRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $post->update($request->validated());
        return redirect()->route('posts.show', $post);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('posts.index');
    }
}
