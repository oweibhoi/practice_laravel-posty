@extends('layout.app')

@section('content')
	<h1>Posts</h1>
	@if(count($posts) > 0)
		@foreach($posts as $post)
				
				@if(!Auth::Guest())
					<!-- @if($post->user_id == auth()->user()->id) -->
						<div class="card">
							<div class="row">
								<div class="col-md-4 col-sm-4">
									<img style="width:100%" src="/storage/cover_photos/{{$post->cover_photo}}">
								</div>
								<div class="col-md-8 col-sm-8">
									<h3 ><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
									<p>Written at {{$post->created_at}} by {{$post->user->name}}</p>
								</div>
							</div>
						</div>
						{{$posts->links()}}<!--//pagination-->

					<!-- @endif -->
				@else
						<div class="card">
							<div class="row">
								<div class="col-md-4 col-sm-4">
									<img style="width:100%" src="/storage/cover_photos/{{$post->cover_photo}}">
								</div>
								<div class="col-md-8 col-sm-8">
									<h3 ><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
									<p>Written at {{$post->created_at}} by {{$post->user->name}}</p>
								</div>
							</div>
						</div>
						{{$posts->links()}}<!--//pagination-->

				@endif

		@endforeach
	@else
		<p>No Post Found!</p>
	@endif
@endsection