<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentFormRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderByDesc('created_at')->paginate(3);
        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::with('comments.user')->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function comment($id, CommentFormRequest $request)
    {
        $post = Post::findOrFail($id);
        $post->comments()->create($request->validated());
        return redirect(route('posts.show', $id));
    }
}
