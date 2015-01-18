@extends('layouts.main')

@section('content')
    
<h1>{{ $title }}</h1>

<p> Welcome to {{ $title }}. </p>
	
	@if( Auth::check())

		<a href="{{ URL::route('todo')}}">Check out my Todo App</a>
	@else	
		<a href="{{ URL::route('login')}}">Eerst inlogen, graag!</a>
	@endif

@stop