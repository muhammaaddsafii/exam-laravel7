@extends('layouts/master')

@section('content')
<div class="container mt-3">
    <div class="d-flex justify-content-between">
        <div>
            <h4>All Post</h4>
            <hr>
        </div>
        <div>
            <a class="btn btn-outline-primary rounded-pill" href="">Create</a>
        </div>
    </div>
    <div class="row">
        @foreach ($posts as $post)
        <div class="col-4 mt-3 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    {{$post->title}}
                </div>
                <div class="card-body">
                    {{Str::limit($post->body, 40, '...')}}
                </div>
                <div class="card-footer d-flex justify-content-between">
                    Published on  {{$post->created_at->diffForHumans()}}
                    <a class="btn btn-warning rounded-pill" href="">Edit</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="d-flex justify-content-center mt-3">
    {{ $posts->links() }}
</div>
@endsection