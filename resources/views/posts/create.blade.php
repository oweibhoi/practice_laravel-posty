
@extends('layout.app')

@section('content')
	<h1>Create Posts</h1>
	{!! Form::open(['action' => 'PostsController@store','method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
    	
    	<div class="form-group">
    		{{Form::label('label','Title')}}
    		{{Form::text('title','',['placeholder'=>'Title','class'=>'form-control'])}}
    		{{Form::label('label','Body')}}
    		{{Form::textarea('body','',['placeholder'=>'Type Here..','class'=>'form-control'])}}
    		{{Form::file('cover_photo')}}
    	</div>
    	{{Form::submit('Save',['class'=>'form-control btn btn-primary btn-sm'])}}
	{!! Form::close() !!}
@endsection