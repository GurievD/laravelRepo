<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActorFormRequest;
use App\Models\Actor;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{
    public function index()
    {
        $actors = Actor::query()
            ->latest()
            ->paginate(10);

        $movies = Movie::query()
            ->latest()
            ->paginate(10);

        return view('actors.index', [
            'actors' => $actors,
            'movies' => $movies
        ]);
    }

    public function create()
    {
        $this->authorize('create', Actor::class);
        $movies = Movie::query()->orderBy('name')->get();

        return view('actors.form', [
            'movies' => $movies
        ]);
    }

    public function store(ActorFormRequest $request)
    {
        $this->authorize('create', Actor::class);
        $data = $this->getData($request);
        $actor = Actor::query()->create($data);

        return redirect()->route('actors.show', $actor);
    }

    public function show(Actor $actor)
    {
        return view('actors.show', [
            'actor' => $actor
        ]);
    }

    public function edit(Actor $actor)
    {
        $this->authorize('update', $actor);

        $movies = Movie::query()->orderBy('name')->get();
        return view('actors.form', [
            'actor' => $actor,
            'movies' => $movies
        ]);
    }

    public function update(ActorFormRequest $request, Actor $actor)
    {
        $this->authorize('update', $actor);
        $data = $this->getData($request);
        $actor->update($data);

        return redirect()->route('actors.show', $actor);
    }

    public function destroy(Actor $actor)
    {
        $this->authorize('delete', $actor);
        $actor->delete();

        return redirect()->route('actors.index');
    }

    protected function uploadImage(ActorFormRequest $request) {
        if(!$request->hasFile('image'))
            return null;

        return $request->file('image')->store('public/images');
    }

    protected function getData(ActorFormRequest $request) {
        $data  = $request->validated();
        $data['image_path'] = $this->uploadImage($request);
        unset($data['image']);

        return $data;
    }

    public function search()
    {
        $search_text = $_GET['query'];

        $actors = DB::table('actors')->where('name', 'like', '%'.$search_text.'%')->get();

        return view('actors.actors_search', ['actors' => $actors]);
    }
}
