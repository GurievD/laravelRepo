<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\ActorComment;
use App\Models\Comment;
use App\Models\Movie;
use App\Models\MovieComment;
use App\Models\Post;
use Illuminate\Http\Request;

class ActorCommentController extends Controller
{
    public function store()
    {
        $request = Request();

        $this->authorize('create', Actor::class);
        $data = $this->validated();
        $data['actor_id'] = $this->getActor($request);

        $actor = Actor::query()
            ->where('id', $this->getActor($request))
            ->first();

        $user = auth()->user();
        $user->actor_comments()
            ->create($data);

        return redirect()->route('actors.show', $actor);
    }

    public function destroy(ActorComment $comment)
    {
        $actor = $comment->actor_id;
        $comment->delete();
        return redirect()->route('actors.show',$actor);
    }

    protected function validated() {
        return request()->validate([
            'content' => 'required|string|min:3'
        ]);
    }

    public function getActor(Request $request) {
        return $request['actor'];
    }
}
