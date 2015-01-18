<div class="nav">
	
	<div class="homeLink"><a href="{{ URL::route('home') }}">home</a></div>
        <nav class="">
            <ul>
            
            @if(Auth::check())
                <li><a href="{{ URL::route('todo') }}"> todos </a></li>
                <li><a href="{{ URL::asset('dashboard') }}"> dashboard </a></li>
                <li><a href="{{ URL::route('logout') }}" >logout ( {{ Auth::user()->email }} ) </a></li>
           @else
                <li><a href="{{ URL::route('login') }}"> login </a></li>
                <li><a href="{{ URL::route('register') }}"> register </a></li>

            @endif
                
              
            </ul>
        </nav>

</div>