@extends('layouts/app')

@section('content')
<div class="container mt-3">
    <div class="d-flex justify-content-between">
        <div>
            @isset($category)
                <h4>Category : {{$category->nama}} </h4> 
            @endisset

            @isset($tag)
                <h4>Tag : {{$tag->name}} </h4> 
            @endisset

            @if(!isset($category) && !isset($tag))
            <h4>All Post</h4>
            @endif    
            <hr>
        </div>
        @if(Auth::check())
            <div>
                <a class="btn btn-outline-primary rounded-pill" href="{{url('/post/create')}}">Create</a>
            </div>
        @else
            <div>
                <a class="btn btn-outline-primary rounded-pill" href="{{url('/login')}}">Login to create</a>
            </div>
        @endif
    </div>
    <div class="row">
        @forelse ($posts as $post)
        <div class="col-md-7 mt-3 mb-3">
            <div class="card h-100">
                <a href="{{url('/post/'.$post->slug)}}">
                    <img class="card-img-top" src="{{ $post->takeImage }}" alt="">
                </a>
                <div class="card-body">
                    <a class="text-decoration-none text-dark" href="{{url('/post/'.$post->slug)}}">
                        <h4>
                            {{$post->title}}
                        </h4>
                    </a>
                    <div>
                        <a class="text-decoration-none" href="/post/categories/{{$post->category->slug}}">{{$post->category->name}}</a> - 
                        @foreach ($post->tags as $tag)
                            <a class="text-decoration-none" href="{{url('/post/tags/'.$tag->slug)}}"> {{$tag->name}} </a>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        {{Str::limit($post->body, 300, '...')}}
                        <a class="text-decoration-none" href="{{url('/post/'.$post->slug)}}"> <br> Read more ...</a>
                    </div>
                </div>
                    <div class="card-footer d-flex justify-content-between">
                        Published on  {{$post->created_at->diffForHumans()}}
                        <div>
                            Author : {{$post->author->name}}
                        </div>
                    </div>
            </div>
        </div>
        @empty
        <div class="col-md-6">
            <div class="alert alert-info">
                There are no post.
            </div>
        </div>
        @endforelse
    </div>
</div>

<div class="d-flex justify-content-center mt-3">
    {{ $posts->links() }}
</div>
@endsection

