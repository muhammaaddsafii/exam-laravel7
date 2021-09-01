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
        $posts = Post::with('author', 'tags', 'category')->latest()->Paginate(6);
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
        $request->validate([
            'thumbnail' => 'image | mimes:jpeg, png, jpg, svg| max:2048'
        ]);

        $thumbnail = request()->file('thumbnail') ? request()->file('thumbnail')->store("images/photos") : null;

        $attr = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category' => 'required',
            'tags' => 'array|required'
        ]);
        $thumbnail = request()->file('thumbnail');

        $slug = Str::slug($request->title);
        $attr['slug'] = $slug;
        $attr['category_id'] = request('category');

        $thumbnailUrl = $thumbnail->store("images/photos");
        $attr['thumbnail'] = $thumbnailUrl;


        $posts = auth()->user()->posts()->create($attr);
        $posts->tags()->attach(request('tags'));

        session()->flash('success', 'The post has created');

        return redirect()->route('post');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $posts = Post::with('author', 'tags', 'category')->where('category_id', $post->category_id)->latest()->limit(6)->get();
        return view('posts/show', ['posts' => $post, 'post' => $posts]);
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
        $this->authorize('update', $post);

        $request->validate([
            'thumbnail' => 'image | mimes:jpeg, png, jpg, svg| max:2048'
        ]);

        $attr = request()->validate([
            'title' => 'required',
            'body' => 'required',
            'category' => 'required',
            'tags' => 'array|required'
        ]);

        if (request()->file('thumbnail')) {
            \Storage::delete($post->thumbnail);
            $thumbnail = request()->file('thumbnail')->store("images/photos");
        } else {
            $thumbnail = $post->thumbnail;
        }

        $attr['thumbnail'] = $thumbnail;

        $att['category_id'] = request('category');
        $post->tags()->sync(request('tags'));
        $post->update($attr);

        session()->flash('success', 'The post has been updated');

        return redirect()->route('post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        \Storage::delete($post->thumbnail);

        $post->tags()->detach();
        $post->delete();

        session()->flash('deleted', 'Data has been deleted');
        return redirect()->route('post');
    }
}
