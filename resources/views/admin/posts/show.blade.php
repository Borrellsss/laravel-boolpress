@extends('layouts.dashboard')

@section('content')
    <h1 class="mb-3">{{$post->title}}</h1>
    <div class="mb-3">
        <strong>Created at:</strong> {{$post->created_at}}
    </div>
    <div class="mb-3">
        <strong>Slug:</strong> {{$post->slug}}
    </div>
    <p class="mb-4">
        {{$post->content}}
    </p>
    <div class="mb-3">
        <strong>Updated at:</strong> {{$post->updated_at}}
    </div>
    <div>
        <a href="" class="btn btn-outline-warning">Modify Post</a>
        <a href="" class="btn btn-outline-danger">Delete</a>
    </div>
@endsection