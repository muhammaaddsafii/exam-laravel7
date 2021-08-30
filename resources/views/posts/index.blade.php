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
        <div class="col-4 mt-3 mb-3">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        {{$post->title}}
                    </div>
                    <div>
                        <a class="text-decoration-none" href="/post/categories/{{$post->category->slug}}">{{$post->category->name}}</a>
                    </div>
                </div>
                <div class="card-body">
                    <img class="card-img-top" src="{{ $post->takeImage }}" alt="">
                    {{Str::limit($post->body, 50, '...')}}
                    <a class="text-decoration-none" href="{{url('/post/'.$post->slug)}}"> <br> Read more ...</a>
                </div>
                    <div class="card-footer d-flex justify-content-between">
                        Published on  {{$post->created_at->diffForHumans()}}
                        @can('update', $post)
                        <a class="btn btn-warning rounded-pill" href="{{url('/post/'.$post->slug.'/edit')}}">Edit</a>
                        @endcan
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