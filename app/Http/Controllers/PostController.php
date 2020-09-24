<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFormRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PostController extends Controller
{

    protected $perPage = 5;

    protected function byModel(Model $model, $view = null) {

        $posts = $model->posts()
            ->latest()
            ->paginate($this->perPage);

        $table = $model->getTable();
        $single = Str::singular($table);

        return view($view ?? "posts.by-$single", [
            'posts' => $posts,
            $single => $model
        ]);
    }

    function byUser(User $user) {
        return $this->byModel($user);
    }

    function byCategory(Category $category) {
        return $this->byModel($category);
    }

    public function index()
    {
        $posts = Post::query()
            ->latest()
            ->paginate($this->perPage);

        $categories = cache()->remember('most-liked-categories', now()->addMinute(), function () {
            return Category::query()
                ->withCount('likes')
                ->orderBy('likes_count', 'desc')
                ->take(5)
                ->get();
        });

        return view('posts.index', [
            'posts' => $posts,
            'categories' => $categories
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
            ->create($this->getData($request));


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
        $post->update($this->getData($request));
        return redirect()->route('posts.show', $post);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();
        return redirect()->route('posts.index');
    }

    protected function uploadImage(PostFormRequest $request) {

        if (!$request->hasFile('image'))
            return null;

        return $request
            ->file('image')
            ->store('public/images');
    }

    protected function getData(PostFormRequest $request) {
        $data = $request->validated();
        $data['image_path'] = $this->uploadImage($request);
        unset($data['image']);
        return $data;
    }
}
