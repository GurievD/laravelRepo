<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Movie;
use App\Models\MovieComment;
use App\Models\Post;
use Illuminate\Http\Request;

class MovieCommentController extends Controller
{
    public function store()
    {
        $request = Request();

        $this->authorize('create', Movie::class);
        $data = $this->validated();
        $data['movie_id'] = $this->getMovie($request);

        $movie = Movie::query()
            ->where('id', $this->getMovie($request))
            ->first();

        $user = auth()->user();
        $user->movie_comments()
            ->create($data);

        return redirect()->route('movies.show', $movie);
    }

    public function destroy(MovieComment $comment)
    {
        $movie = $comment->movie_id;
        $comment->delete();
        return redirect()->route('movies.show',$movie);
    }

    protected function validated() {
        return request()->validate([
            'content' => 'required|string|min:3'
        ]);
    }

    public function getMovie(Request $request) {
        return $request['movie'];
    }
}
