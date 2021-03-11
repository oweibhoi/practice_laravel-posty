@extends('layout.app')

@section('content')
	<a href="/posts" class="btn btn-default">Go Back</a>
	<img style="width:100%" src="/storage/cover_photos/{{$posts->cover_photo}}">
	<br>
	<h1>{{$posts->title}}</h1>
	
	<div>
		{{$posts->body}}
	</div>
	<hr>
	<small>Created at {{$posts->created_at}} by {{$posts->user->name}}</small>
	<hr>
	@if(!Auth::Guest())
		<a href="/posts/{{$posts->id}}/edit" class="btn btn-success">Edit</a>
	
		{!! Form::open(['action' => ['PostsController@destroy',$posts->id],'method'=>'POST','class'=>'pull-right']) !!}
	    	{{Form::hidden('_method','DELETE')}}
	    	{{Form::submit('Delete',['class'=>' btn btn-danger btn-sm'])}}
		{!! Form::close() !!}
	@endif
@endsection