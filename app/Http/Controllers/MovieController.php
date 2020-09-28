<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieFormRequest;
use App\Models\Actor;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    protected $perPage = 20;

    public function byGenre(Genre $genre) {
        $movies = $genre->movies()->latest()->paginate($this->perPage);

        return view('movies.by-genre', [
            'movies' => $movies,
            'genre' => $genre
        ]);
    }

    public function byActor(Actor $actor) {
        $movies = $actor->movies()->latest()->paginate($this->perPage);

        return view('movies.by-actor', [
            'movies' => $movies,
            'actor' => $actor
        ]);
    }

    public function index()
    {
        $movies = Movie::query()
            ->latest()
            ->paginate($this->perPage);

        $genres = cache()->remember('genres', now()->addMinute(), function () {
            return Genre::query()
                ->take(5)
                ->get();
        });

        $actors = cache()->remember('actors', now()->addMinute(), function () {
            return Actor::query()
                ->take(5)
                ->get();
        });

        return view('movies.index', [
            'movies' => $movies,
            'genres' => $genres,
            'actors' => $actors
        ]);
    }

    public function create()
    {
        $this->authorize('create', Movie::class);
        $genres = Genre::query()->orderBy('name')->get();
        $actors = Actor::query()->orderBy('name')->get();

        return view('movies.form', [
            'genres' => $genres,
            'actors' => $actors
        ]);
    }

    public function store(MovieFormRequest $request)
    {
        $this->authorize('create', Movie::class);

        $data = $this->getData($request);
        $movie = Movie::query()->create($data);
        $movie->actors()->sync($data['actors']);

        return redirect()->route('movies.show', $movie);
    }

    public function show(Movie $movie)
    {
        return view('movies.show', [
            'movie' => $movie
        ]);
    }

    public function edit(Movie $movie)
    {
        $this->authorize('update', $movie);
        $genres = Genre::query()->orderBy('name')->get();
        $actors = Actor::query()->orderBy('name')->get();

        return view('movies.form', [
            'movie' => $movie,
            'genres' => $genres,
            'actors' => $actors
        ]);
    }

    public function update(MovieFormRequest $request, Movie $movie)
    {
        $this->authorize('update', $movie);
        $data = $this->getData($request);
        $movie->update($data);
        $movie->actors()->sync($data['actors']);

        return redirect()->route('movies.show', $movie);
    }

    public function destroy(Movie $movie)
    {
        $this->authorize('delete', $movie);
        $movie->delete();

        return redirect()->route('movies.index');
    }

    protected function uploadImage(MovieFormRequest $request) {
        if(!$request->hasFile('image'))
            return null;

        return $request
            ->file('image')
            ->store('public/images');
    }

    protected function getData(MovieFormRequest $request) {
        $data  = $request->validated();
        $data['image_path'] = $this->uploadImage($request);
        unset($data['image']);

        return $data;
    }

    public function search()
    {
        $search_text = $_GET['query'];

        $movies = DB::table('movies')->where('name', 'like', '%'.$search_text.'%')->get();

        return view('movies.movies_search', ['movies' => $movies]);
    }
}
