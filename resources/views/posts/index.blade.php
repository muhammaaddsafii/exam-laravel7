@extends('layouts/master')

@section('content')
<div class="container mt-3">
    <div class="d-flex justify-content-between">
        <h4>All Post</h4>
        <a class="btn btn-outline-primary rounded-pill" href="">Create</a>
    </div>
    <div>
        <div class="card mt-3" style="width: 18rem;">
            <div class="card-header">
                Title
            </div>
            <div class="card-body">
                Body
            </div>
            <div class="card-footer d-flex justify-content-between">
                Footer
                <a class="btn btn-warning rounded-pill" href="">Edit</a>
            </div>
        </div>
    </div>
</div>
@endsection