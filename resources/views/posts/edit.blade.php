@extends('layouts/master')

@section('content')

<div class="container mt-3">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    EDIT POST : {{$posts->title}}
                </div>
                <div class="card-body">
                    <form action="/post/{{$posts->slug}}/edit" method="POST">
                        @method('patch')
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') ?? $posts->title }}">
                            @error('title')
                            <div class="mt-2 text-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" id="body" class="form-control">{{ old('body') ?? $posts->body }}</textarea>
                            @error('body')
                            <div class="mt-2 text-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection