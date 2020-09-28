<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Movie;
use App\Models\Post;
use App\Models\User;

class LikeController extends Controller
{

    function toggle(Post $post) {
        /** @var User $user */
        $user = auth()->user();
        $likes = $post->likes();

        if ($post->isLikedBy($user))
            $likes->where('user_id', $user->id)->delete();
        else
            $likes->create([
                'user_id' => $user->id
            ]);

        return back();
    }

    function movie_toggle(Movie $movie) {
        /** @var User $user */
        $user = auth()->user();
        $likes = $movie->movie_likes();

        if ($movie->isLikedBy($user))
            $likes->where('user_id', $user->id)->delete();
        else
            $likes->create([
                'user_id' => $user->id
            ]);

        return back();
    }

    function actor_toggle(Actor $actor) {
        /** @var User $user */
        $user = auth()->user();
        $likes = $actor->actor_likes();

        if ($actor->isLikedBy($user))
            $likes->where('user_id', $user->id)->delete();
        else
            $likes->create([
                'user_id' => $user->id
            ]);

        return back();
    }

}
