@extends('layouts.dashboard')

@section('content')
    <form action="{{route('admin.posts.update', ['post' => $post->id])}}" method="POST" enctype="multipart/form-data">
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
            <label for="post-cover" class="form-label">Post Cover</label>
            <input class="form-control mb-3" type="file" id="post-cover" name="post-cover">
            @if ($post->cover)
                <div class="mb-3">
                    Current Post Cover:
                    <div>
                        <img class="w-50" src="{{asset('storage/' . $post->cover)}}" alt="">
                    </div>
                </div>
            @endif
            @error('post-cover')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <h6>Tags</h6>
            @foreach ($tags as $tag)
                @if ($errors->any())
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$tag->id}}" id="tag-{{$tag->id}}" name="tags[]" {{in_array($tag->id, old('tags', [])) ? 'checked' : ''}}>
                        <label class="form-check-label" for="flexCheckDefault">
                            {{$tag->name}}
                        </label>
                    </div>
                @else
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$tag->id}}" id="tag-{{$tag->id}}" name="tags[]" {{$post->tags->contains($tag) ? 'checked' : ''}}>
                        <label class="form-check-label" for="flexCheckDefault">
                            {{$tag->name}}
                        </label>
                    </div>
                @endif
                
            @endforeach
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