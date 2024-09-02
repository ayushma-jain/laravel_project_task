@extends('layouts.app')
@section('title')
Create Post
@endsection
@section('content')
<div class="container">
    <div class="row">

        <h1 class="col-12">Create Post</h1><hr/>

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="form-group col-12">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group col-12 mt-4">
                <label for="description">Body</label>
                <textarea name="description" id="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-success mt-3 col-3">Create Post</button>
        </form>
    </div>
</div>
@endsection
