@extends('layouts/app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="mt-3 mb-3">
                <div class="card h-100">
                    <img style="height:450px; object-fit:cover; object-position:center" class="rounded" src="{{ $posts->takeImage }}" alt="">
                    <div class="card-body">
                        <h4>
                            {{$posts->title}}
                        </h4>
                            Author : {{$posts->author->name}}
                        <div class="text-secondary d-flex justify-content-between mt-3">
                            <div>
                                Category : <a class="text-decoration-none" href="/post/categories/{{$posts->category->slug}}">{{$posts->category->name}}</a> 
                            </div>
                            <div>
                                Tags : 
                                @foreach ($posts->tags as $tag)
                                <a href="{{url('/post/tags/'.$tag->slug)}}" class="text-decoration-none">{{$tag->name}}</a>
                                @endforeach
                            </div>
                            <div>
                                {{$posts->created_at->format("d F, Y")}}
                            </div>
                        </div>
                        <hr>
                        {!!nl2br ($posts->body) !!}
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        Published on  {{$posts->created_at->diffForHumans()}}
                        <!-- Button trigger modal -->
                        <div>
                            @can('update', $posts)
                                <a class="btn btn-warning rounded-pill" href="{{url('/post/'.$posts->slug.'/edit')}}">Edit</a>
                            @endcan
                            @can('delete', $posts)
                            <button type="button" class="btn btn-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#myModal">
                                Delete
                            </button>
                            @endcan
                        </div>       
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{$posts->title}}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Anda yakin ingin menghapusnya ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning rounded-pill" data-bs-dismiss="modal">Cancel</button>
                                <form action="{{url('/post/'.$posts->slug.'/delete')}}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger rounded-pill">Delete</button>
                                </form>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @foreach ($post as $post)
            <div class="mt-3 mb-3">
                <div class="card">
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
                            {{Str::limit($post->body, 100, '...')}}
                            <a class="text-decoration-none" href="{{url('/post/'.$post->slug)}}"> <br> Read more ...</a>
                        </div>
                    </div>
                        <div class="card-footer d-flex justify-content-between">
                            <div>
                                Author : {{$post->author->name}}
                            </div>
                        </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection