@extends('layouts.main')

@section('content')
   <h1> {{ $title }} </h1>


@if (!empty($todos)  || !empty($dones))

	<h2>Wat moet er allemaal gebeuren?</h2>

	<a href="{{ URL::route('todo-add') }}">Voeg Toe</a>

	<h3>Todos</h3>

		@foreach ( $todos as $todo )
					
			<div class="item">
				<span class="activate" title="Vink maar af">
					
					<a class="icon" href="{{ URL::route('todo-changeStatus', $todo['id']) }}" ></a>
				
				</span>
					
				<span>{{ $todo['name'] }}</span>
				
				<span class="delete" title="Verwijder dit maar">
					
					<a class="icon" href="{{ URL::route('todo-delete', $todo['id']) }}" ></a>
				</span>
			</div>

   		@endforeach

   			@if( empty($todos) )

   				<p>Allright, all done!</p>

   			@endif

   	<h3>Dones</h3>
			
   		@foreach ( $dones as $todo )

  	 		<div class="item">

   				<span class="activate" title="Check , if it's done">
						
					<a class="icon" href="{{ URL::route('todo-changeStatus', $todo['id']) }}" ></a>
					
				</span>
					
				<span>{{ $todo['name'] }}</span>
				
					<span class="delete" title="Verwijder dit maar">
							
						<a class="icon" href="{{ URL::route('todo-delete', $todo['id']) }}" ></a>
					
					</span>
				</div>

   		@endforeach

   			@if( empty($dones))

   				<p>Damn, werk aan de winkel...</p>

   			@endif
   					
@else
   	Nog geen todo-items. <a href="{{ URL::route('todo-add') }}">Voeg Toe</a>
	
@endif

@stop