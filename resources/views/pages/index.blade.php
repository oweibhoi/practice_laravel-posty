@extends('layout.app')

@section('content')
<div class="jumbotron text-center">
     <h1>{{$title}}</h1>
       <p>This is the main page of the website.</p>
       <p><a href="/login" class="btn btn-primary btn-lg" role="button">Login</a> <a href="/register" class="btn btn-lg btn-success" role="button">Register</a></p>
</div>
      
@endsection