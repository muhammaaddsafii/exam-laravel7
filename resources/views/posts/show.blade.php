@extends('layouts/app')

@section('content')
<div class="container">
    <div class="row">
        <div class="mt-3 mb-3">
            <div class="card h-100">
                <div class="card-header text-center">
                    {{$posts->title}}
                </div>
                <div class="card-body">
                    <div class="text-secondary d-flex justify-content-between">
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
                    {{$posts->body}}
                </div>
                <div class="card-footer d-flex justify-content-between">
                    Published on  {{$posts->created_at->diffForHumans()}}

                    <div>
                        Author : {{$posts->author->name}}
                    </div>
                    <!-- Button trigger modal -->
                    @auth
                        <button type="button" class="btn btn-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#myModal">
                            Delete
                        </button>
                    @endauth                    
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
</div>
@endsection