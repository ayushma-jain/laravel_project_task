@extends('layouts.app')
@section('title','Create Availability')
@section('content')
 
    {{-- <title>Create Availability</title> --}}
<div class="form-group">
    <div class="row">
        <div class="col-12">
            <h1>Create Availability</h1>
            @if($errors->any())
                <div style="color: red;">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('availabilities.store') }}">
                @csrf
                <div class="row">
                    <div class="col-6 py-3">
                        <label for="category_id">Category</label>
                        <select class="form-control" name="category_id" id="category_id" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 py-3">
                        <label for="date">Date</label>
                        <input class="form-control" type="date" name="date" id="date" required />        
                    </div>
                    <div class="col-3 py-3">
                        <label for="start_time">Start Time</label>
                        <input type="time" class="form-control" name="start_time" id="start_time" required />
                    </div>
                    <div class="col-3 py-3">
                        <label for="end_time">End Time</label>
                        <input type="time" class="form-control" name="end_time" id="end_time" required/>        
                    </div>
                    <div class="col-3 py-3">
                        <label for="interval">Interval (minutes)</label>
                        <input class="form-control" type="number" name="interval" id="interval" min="1" required / >
                    </div>
                    <div class="col-3 mt-4 pt-3">
                        <button class="btn btn-success w-100" type="submit">Save</button>
                    </div>
                    
                </div>
                
            </form>
        </div>

    </div>
    <hr/>
    <table class="table table-bordered pt-4">
        <thead>
            <tr>
                <th>Category</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Interval</th>
            </tr>
        </thead>
        <tbody>
            @foreach($availabilities as $availability)
                <tr>
                    <td>{{ $availability->category->name }}</td>
                    <td>{{ $availability->date }}</td>
                    <td>{{ $availability->start_time }}</td>
                    <td>{{ $availability->end_time }}</td>
                    <td>{{ $availability->interval ." mins"}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
