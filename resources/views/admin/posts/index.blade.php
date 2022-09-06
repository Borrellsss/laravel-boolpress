@extends('layouts.dashboard')

@section('content')
    @if (count($confirm_deleted_post) > 0)
        <div class="alert alert-success" role="alert">
            Post Succesfully Eleminated!
        </div>
    @endif
    <div class="row row-cols-2">
        @foreach ($posts as $post)
            <div class="col mb-4">
                <div class="card">
                    {{-- <img src="..." class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                        <h4 class="card-title">{{$post->title}}</h4>
                        <div class="mb-3">
                            <strong>Updated at:</strong> {{$post->updated_at->format('D d/m/Y - H:i')}}
                        </div>
                        @if ($post->update_difference_in_days > 0)
                            <div class="mb-3">
                                Updated: <strong>{{$post->update_difference_in_days}}</strong>  day{{$post->update_difference_in_days > 1 ? 's' : ''}} ago
                            </div>
                        @endif
                        <form action="{{route('admin.posts.destroy', ['post' => $post->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{route('admin.posts.show', ['post' => $post->id])}}" class="btn btn-info">Show Post</a>
                            <a href="{{route('admin.posts.edit', ['post' => $post->id])}}" class="btn btn-warning">Modify Post</a>
                            <input class="btn btn-danger" type="submit" value="Delete" onClick="return confirm('Do you really want to eliminate this Post?')">
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection