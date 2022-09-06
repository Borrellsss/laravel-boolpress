@extends('layouts.dashboard')

@section('content')
    <h1 class="mb-3">{{$post->title}}</h1>
    <div class="mb-3">
        <strong>Created at:</strong> {{$post->created_at->format('D d/m/Y - H:i')}}
    </div>
    <div class="mb-3">
        <strong>Slug:</strong> {{$post->slug}}
    </div>
    <p class="mb-4">
        {{$post->content}}
    </p>
    <div class="mb-3">
        <strong>Updated at:</strong> {{$post->updated_at->format('D d/m/Y - H:i')}}
    </div>
    @if ($post->time_span > 0)
        <div class="mb-3">
            Updated: <strong>{{$post->time_span}}</strong>  day{{$post->time_span > 1 ? 's' : ''}} ago
        </div>
    @endif
    <form action="{{route('admin.posts.destroy', ['post' => $post->id])}}" method="post">
        @csrf
        @method('DELETE')

        <a href="{{route('admin.posts.edit', ['post' => $post->id])}}" class="btn btn-warning">Modify Post</a>
        <input class="btn btn-danger" type="submit" value="Delete" onClick="return confirm('Do you really want to eliminate this Post?')">
    </form>
@endsection