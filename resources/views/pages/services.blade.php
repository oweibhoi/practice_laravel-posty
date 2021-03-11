@extends('layout.app')

@section('content')
       <h1>{{$title}}</h1>
       <ul class="list-group">
          <p>This is our services that can we offer for you.</p>
               @if(count($services) > 0 )
                    @foreach($services as $service)
                        <li class="list-group-item">{{$service}}</li>
                    @endforeach
               @endif
          
       </ul>
     
@endsection
