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
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select" id="category_id" name="category_id">
                <option value="" selected>None</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}" {{old('category_id', isset($post->category->id) ? $post->category->id : '') == $category->id ? 'selected' : ''}}>{{ucFirst($category->name)}}</option>
                @endforeach
            </select>
            @error('category_id')
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