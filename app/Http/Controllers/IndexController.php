<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $posts = Post::orderByDesc('created_at')->limit(3)->get();
        return view('welcome', compact('posts'));
    }
}
