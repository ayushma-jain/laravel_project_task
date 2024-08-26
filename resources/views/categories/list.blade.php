@extends('layouts.app')
@section('title')
Categories List
@endsection
@section('content')

    <h1>Categories</h1>
    
        <form class="form-group" method="POST" action="{{ route('categories.store') }}">
            @csrf
            <div class="row py-4">
                <label for="name">Category Name</label>
                <div class="col-10">
                    
                    <input class="form-control" type="text" name="name" id="name" required />
                </div>
                <button class="btn btn-success col-2" type="submit">Save</button>
            </div>            
        </form>
    

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection