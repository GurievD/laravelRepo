<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;

class CategoryController extends Controller
{

    public function index(User $user)
    {

        $categories = $user->categories()->get();

        return view('categories.index', [
            'categories' => $categories,
            'user' => $user
        ]);
    }

    public function create()
    {
        $this->authorize('create', Category::class);
        return view('categories.form');
    }

    public function store()
    {

        $this->authorize('create', Category::class);
        $data = $this->validated();



        /** @var User $user */
        $user = auth()->user();
        $user->categories()->create($data);

        $categories = $user->categories()->get();

        if(isset($data['active']))
            return view('categories.lorem', ['categories' => $categories]);

        return redirect()->route('categories.index', $user);
    }

    public function show(Category $category)
    {
        return view('categories.show', [
            'category' => $category
        ]);
    }

    public function edit(Category $category)
    {
        $this->authorize('update', $category);

        return view('categories.form', [
            'category' => $category
        ]);
    }

    public function update(Category $category)
    {
        $this->authorize('update', $category);

        $data = $this->validated();
        $category->update($data);

        if(isset($data['active']))
            return view('categories.lorem');

        return redirect()->route('categories.show', $category);
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);

        $category->delete();
//        return back();
        return redirect()->route('categories.index', auth()->user());

    }

    protected function validated() {
        return request()->validate([
            'name' => 'required|string|min:5',
            'active' => 'boolean'

        ]);
    }

}
