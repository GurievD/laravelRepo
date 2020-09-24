<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreFormRequest;
use App\Models\Genre;

class GenreController extends Controller
{
    protected $perPage = 3;

    function getGenre() {
        return Genre::query()
            ->orderBy('genre_name')
            ->paginate($this->perPage);
    }

    public function index()
    {
        $this->authorize('viewAny', Genre::class);

        $genres = $this->getGenre();

        return view('genres.index', ['genres' => $genres]);
    }

    public function create()
    {
        $this->authorize('create', Genre::class);

        return view('genres.form');
    }

    public function store(GenreFormRequest $request)
    {
        $this->authorize('create', Genre::class);

        Genre::query()->create($request->validated());
        $genres = $this->getGenre();

        return redirect()->route('genres.index', ['genres' => $genres]);
    }

    public function edit(Genre $genre)
    {
        $this->authorize('update', $genre);

        return view('genres.form', ['genre' => $genre]);
    }

    public function update(GenreFormRequest $request, Genre $genre)
    {
        $this->authorize('update', $genre);

        $genre->update($request->validated());
        $genres = $this->getGenre();

        return redirect()->route('genres.index', ['genres' => $genres]);
    }

    public function destroy(Genre $genre)
    {
        $this->authorize('delete', $genre);

        $genre->delete();
//        return back();

        return redirect()->route('genres.index', auth()->user());

    }


}
