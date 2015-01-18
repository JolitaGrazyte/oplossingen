@extends('layouts.main')

@section('content')

    <h1>{{ $title }}</h1>

    {{ Form::open() }}

     @if(Session::has('inputerror'))

        <p class="{{ Session::get('message-class') }}">{{ Session::get('inputerror') }}</p>

    @endif

    <label for="email" class="email">Email:</label>
    <div class="field">

        <input type="text" name="email" placeholder="Username" {{ Input::old('email') ? 'value="'.e(Input::old('email')).'"' : '' }}> 

    </div>

    <label for="password">Password:</label>
    <div class="field">

        <input type="password" name="password" placeholder="Password">
        
    </div>

    <div class="field">
        <input type="checkbox" name="remember" id="remember"></input>
        <label for="remember" class="remember">Remember me</label>
    </div>

    <div><input type="submit" name="submit"></div>

    {{ Form::close() }}

@stop