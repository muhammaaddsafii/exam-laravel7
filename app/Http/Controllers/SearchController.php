<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function post()
    {
        $query = request('query');

        $posts = Post::where("title", "like", "%$query%")->orwhere("body", "like", "%$query%")->latest()->paginate(6);
        return view('posts/index', ["posts" => $posts]);
    }
}
