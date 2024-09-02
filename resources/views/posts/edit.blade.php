@extends('layouts.app')
@section('title')
Edit Post
@endsection

@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-12">Edit Post</h1>
        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')
    
            <div class="form-group col-12">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $post->title) }}" required>
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
    
            <div class="form-group col-12 mt-4">
                <label for="description">Body</label>
                <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description', $post->description) }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-3">
                <button type="submit" class="btn btn-success w-100 mt-4">Update Post</button>
            </div>
        </form>
    </div>
</div>
@endsection
