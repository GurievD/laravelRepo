<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActorFormRequest;
use App\Models\Actor;

class ActorController extends Controller
{
    protected $perPage = 3;


    public function index()
    {
        $actors = Actor::query()
            ->latest()
            ->paginate($this->perPage);

        return view('actors.index', [
            'actors' => $actors
        ]);
    }

    public function create()
    {
        $this->authorize('create', Actor::class);

        return view('actors.form');
    }

    public function store(ActorFormRequest $request)
    {
        $this->authorize('create', Actor::class);

        $actor = Actor::query()->create($this->getData($request));

        return redirect()->route('actors.show', $actor);
    }

    public function show(Actor $actor)
    {
        $this->authorize('view', $actor);

        return view('actors.show', [
            'actor' => $actor
        ]);
    }

    public function edit(Actor $actor)
    {
        $this->authorize('update', $actor);

        return view('actors.form', ['actor' => $actor]);
    }

    public function update(ActorFormRequest $request, Actor $actor)
    {
        $this->authorize('update', $actor);

        $actor->update($this->getData($request));

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

        return $request
            ->file('image')
            ->store('public/images');
    }

    protected function getData(ActorFormRequest $request) {
        $data  = $request->validated();
        $data['image_path'] = $this->uploadImage($request);
        unset($data['image']);

        return $data;
    }
}

//
