
@extends('layout.app')

@section('content')
	<h1>Edit Posts</h1>
	{!! Form::open(['action' => ['PostsController@update',$posts->id],'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
    	
    	<div class="form-group">
    		{{Form::label('label','Title')}}
    		{{Form::text('title',$posts->title,['placeholder'=>'Title','class'=>'form-control'])}}
    		{{Form::label('label','Body')}}
    		{{Form::textarea('body',$posts->body,['placeholder'=>'Type Here..','class'=>'form-control'])}}
    		{{Form::file('cover_photo')}}
    	</div>
    	{{Form::hidden('_method','PUT')}}
    	{{Form::submit('Save',['class'=>'form-control btn btn-primary btn-sm'])}}
	{!! Form::close() !!}
@endsection