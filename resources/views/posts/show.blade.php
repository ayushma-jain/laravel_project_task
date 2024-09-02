@extends('layouts.app')
@section('title')
Show Post
@endsection
@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->body }}</p>
    <small>Posted on {{ $post->created_at->format('F j, Y, g:i a') }}</small>

    @auth
        @if (auth()->user()->id === $post->user_id)
            <div class="mt-3">
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>

                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        @endif
    @endauth
</div>
@endsection
