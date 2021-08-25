<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Tag $tag)
    {
        $posts = $tag->posts()->latest()->paginate(6);
        return view('posts/index', compact('posts', 'tag'));
    }
}
