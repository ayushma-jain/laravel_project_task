@extends('layouts.app')
@section('title')
Home Page
@endsection
@section('content')
<div class="container">
   <div class="row">
      @foreach ($posts as $key=>$post)
         <div class="col-3 col-sm-12 col-xs-12">
            <div class="card">
               <div class="card-header">
                  <small>{{$post->title}}</small>
               </div>
               <div class="card-body" style="height:100px;">
                  <div class="card-text">{{$post->description}}</div>
               </div>
               <div class="card-footer">
                  <small>Posted on {{ $post->created_at->format('F j, Y, g:i a') }}</small>
               </div>
            </div>
         </div>
      @endforeach
   </div>
</div>
@endsection
