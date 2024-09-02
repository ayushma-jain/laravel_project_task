@extends('layouts.app')
@section('title')
Posts List
@endsection
@section('content')
<div class="container">
    <div class="row">
        <h1 class="col-10">All Posts</h1>
        <div class="col-2">
            <a href="{{ route('posts.create') }}" class="btn btn-primary w-100">Create New Post</a>
        </div>
        <div class="col-12">
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $key=>$post)
                        <tr>
                            <td>
                                {{++$key  }}
                            </td>
                            <td><a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></td>
                            <td>
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm float-right">Edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="mr-2 d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
