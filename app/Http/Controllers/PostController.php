<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Contracts\Service\Attribute\Required;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->Paginate(6);
        return view('posts/index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $tags = Tag::get();
        return view('posts/create', [
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category' => 'required',
            'tags' => 'array|required'
        ]);

        $attr['slug'] = Str::slug($request->title);
        $attr['category_id'] = request('category');

        $posts = Post::create($attr);
        $posts->tags()->attach(request('tags'));

        session()->flash('success', 'The post has created');

        return redirect()->to('/post');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        return view('posts/show', ['posts' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::get();
        $tags = Tag::get();
        return view('posts/edit', [
            'posts' => $post,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $attr = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'category' => 'required',
            'tags' => 'array|required'
        ]);

        $att['category_id'] = request('category');
        $post->tags()->sync(request('tags'));
        $post->update($attr);

        session()->flash('success', 'The post has been updated');

        return redirect()->to('post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->detach();
        $post->delete();

        session()->flash('deleted', 'Data has been deleted');
        return redirect('post');
    }
}
