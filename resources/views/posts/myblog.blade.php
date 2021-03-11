@extends('layout.app')

@section('content')
	<h1>Posts</h1>
	@if(count($posts) > 0)
		@foreach($posts as $post)
				
				@if(!Auth::Guest())
					@if($post->user_id == auth()->user()->id)
						<div class="card">
							<h3 ><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
							<p>Written at {{$post->created_at}} by {{$post->user->name}}</p>
						</div>
						{{$posts->links()}}

					@endif
				@else
						<div class="card">
							<h3 ><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
							<p>Written at {{$post->created_at}} by {{$post->user->name}}</p>
						</div>
						{{$posts->links()}}
				@endif

		@endforeach
	@else
		<p>No Post Found!</p>
	@endif
@endsection