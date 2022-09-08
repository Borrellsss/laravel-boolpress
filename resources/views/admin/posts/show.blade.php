@extends('layouts.dashboard')

@section('content')
    <h1 class="mb-3">{{$post->title}}</h1>
    <div class="mb-3">
        <strong>Slug:</strong> {{$post->slug}}
    </div>
    <div class="mb-3">
        <strong>Updated at:</strong> {{$post->updated_at->format('D d/m/Y - H:i')}}
        @if ($post->time_span > 0)
            / <strong>{{$post->time_span}}</strong> {{$post->time_span > 1 ? $date_format . 's' : $date_format}} ago
        @endif
    </div>
    <div class="mb-3">
        <strong>Category: </strong> {{$post->category ? ucFirst($post->category->name) : 'None'}}
    </div>
    <div class="mb-3">
        <strong>Tags: </strong>
        @forelse ($post->tags as $tag)
            {{$tag->name}}{{!$loop->last ? ',' : ''}}
        @empty
            None
        @endforelse
    </div>
    <p class="mb-4">
        {{$post->content}}
    </p>
    <div class="mb-3">
        <strong>Created at:</strong> {{$post->created_at->format('D d/m/Y - H:i')}}
    </div>
    <form action="{{route('admin.posts.destroy', ['post' => $post->id])}}" method="post">
        @csrf
        @method('DELETE')

        <a href="{{route('admin.posts.edit', ['post' => $post->id])}}" class="btn btn-warning">Modify Post</a>
        <input class="btn btn-danger" type="submit" value="Delete" onClick="return confirm('Do you really want to eliminate this Post?')">
    </form>
@endsection