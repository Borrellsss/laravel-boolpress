@extends('layouts.dashboard')

@section('content')
    <div class="row row-cols-2">
        @foreach ($posts as $post)
            <div class="col mb-4">
                <div class="card">
                    {{-- <img src="..." class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                        <h4 class="card-title">{{$post->title}}</h4>
                        <div class="mb-3">
                            <strong>Updated at:</strong> {{$post->updated_at}}
                        </div>
                        <a href="{{route('admin.posts.show', ['post' => $post->id])}}" class="btn btn-outline-info">Show Post</a>
                        <a href="" class="btn btn-outline-warning">Modify Post</a>
                        <a href="" class="btn btn-outline-danger">Delete</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection