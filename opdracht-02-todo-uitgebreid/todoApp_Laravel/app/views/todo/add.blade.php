@extends('layouts.main')

@section('content')
   <h1> {{ $title }} </h1>


	{{ Form::open() }}

    <div class="field">
    	<input 
    		type="text" 
    		name="todo" >

    		@if(Session::has('inputerror'))
                <p class="{{ Session::get('message-class') }}">{{ Session::get('inputerror') }}</p>
            @endif

    </div>

    <div><input type="submit" name="submit"></div>

    {{ Form::close() }}

@stop