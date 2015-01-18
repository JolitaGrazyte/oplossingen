@extends('layouts.main')

@section('content')
    
    <h1> {{ $title }} </h1>

	@if( Auth::check())

		<a href="{{ URL::route('todo')}}">Check out my Todo App</a>

	@endif

@stop