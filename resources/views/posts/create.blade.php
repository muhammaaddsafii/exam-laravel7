@extends('layouts/master')

@section('content')

<div class="container mt-3">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    NEW POST
                </div>
                <div class="card-body">
                    <form action="/post/create" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control">
                            @error('title')
                            <div class="mt-2 text-danger">
                                
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body" id="body" class="form-control"></textarea>
                            <div class="mt-2 text-danger">
                                
                            </div>
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