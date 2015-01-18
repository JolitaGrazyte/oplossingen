@extends('layouts.main')

@section('content')

<p>Please register:</p>


{{ Form::open(  array('autocomplete' => 'off' ) )}}
    
    <label for="email" class="email">Email:</label>

        <div class="field">
            <input 
                type="text" 
                name="email" 
                placeholder="Username" {{ Input::old('email') ? 'value="'.e(Input::old('email')).'"' : '' }}> 
    	
            @if( $errors->has('email') )
    		  <span class="inputerror">{{ $errors->first('email') }}</span>
    	   @endif
        </div>

    <label for="password">Password:</label>
        
        <div class="field">
            <input type="password" name="password" placeholder="Password">
    	   
            @if( $errors->has('password') )
    		  <span class="inputerror">{{ $errors->first('password') }}</span>
    	   @endif
        </div>

    <label for="password">Retype password:</label>

        <div class="field">
            <input type="password" name="retype-password" placeholder="Password">
            
            @if( $errors->has('retype-password') )
                <span class="inputerror">{{ $errors->first('retype-password') }}</span>
            @endif
        </div>

    <div><input type="submit" name="submit"></div>

{{ Form::close() }}

@stop