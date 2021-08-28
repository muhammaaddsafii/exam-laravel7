@extends('layouts/app')

@section('content')

<div class="container mt-3">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    NEW POST
                </div>
                <div class="card-body">
                    <form action="{{url('/post/store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control">
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
                                <option value="{{$category->id}}">{{$category->name}}</option>
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
                            <textarea name="body" id="body" class="form-control"></textarea>
                            @error('body')
                            <div class="mt-2 text-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection