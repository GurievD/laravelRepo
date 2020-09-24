<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store()
    {
        $request = Request();

        $this->authorize('create', Post::class);
        $data = $this->validated();
        $data['post_id'] = $this->getPost($request);

        $post = Post::query()
            ->where('id', $this->getPost($request))
            ->first();

        $user = auth()->user();
        $user->post_comments()
            ->create($data);

        return redirect()->route('posts.show', $post);
    }

    public function destroy(Comment $comment)
    {
        $post = $comment->post_id;
        $comment->delete();
        return redirect()->route('posts.show',$post);
    }

    protected function validated() {
        return request()->validate([
            'content' => 'required|string|min:3'
        ]);
    }

    public function getPost(Request $request) {
        return $request['post'];
    }
}
