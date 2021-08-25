@extends('layouts/app')

@section('content')

<div class="container mt-3">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    EDIT POST : {{$posts->title}}
                </div>
                <div class="card-body">
                    <form action="{{url('/post/'.$posts->slug.'/edit')}}" method="POST">
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
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value="" selected disabled>Chose Category :</option>
                                    @foreach ($categories as $category)
                                <option {{$category->id == $posts->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->nama}}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <div class="mt-2 text-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tags">Tag</label>
                            <select name="tags[]" id="tags" class="form-control select2" multiple>
                                @foreach ($posts->tags as $tag)
                                    <option selected value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                                @foreach ($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                            @error('tags')
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
                        <button type="submit" class="btn btn-primary rounded-pill">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection