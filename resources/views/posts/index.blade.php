@extends('layouts/master')

@section('content')
<div class="container mt-3">
    <div class="d-flex justify-content-between">
        <div>
            <h4>All Post</h4>
            <hr>
        </div>
        <div>
            <a class="btn btn-outline-primary rounded-pill" href="/post/create">Create</a>
        </div>
    </div>
    <div class="row">
        @forelse ($posts as $post)
        <div class="col-4 mt-3 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    {{$post->title}}
                </div>
                <div class="card-body">
                    {{Str::limit($post->body, 40, '...')}}
                    <a class="text-decoration-none" href="/post/{{$post->slug}}">Read more ...</a>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    Published on  {{$post->created_at->diffForHumans()}}
                    <a class="btn btn-warning rounded-pill" href="/post/{{$post->slug}}/edit">Edit</a>
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