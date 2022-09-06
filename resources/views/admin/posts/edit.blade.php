@extends('layouts.dashboard')

@section('content')
    <form action="{{route('admin.posts.update', ['post' => $post->id])}}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Post Title</label>
            <input type="text" class="form-control mb-2" id="title" name="title" value="{{old('title', $post->title)}}">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Post Content</label>
            <textarea class="form-control mb-2" id="content" name="content" rows="5">{{old('content', $post->content)}}</textarea>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <input class="btn btn-primary" type="submit" value="Save">
    </form>
@endsection