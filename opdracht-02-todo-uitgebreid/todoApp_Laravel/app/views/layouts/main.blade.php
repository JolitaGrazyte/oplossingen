<html>
 <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Todo App [Laravel]</title>
        <link rel="stylesheet" href=" ">
        <link rel="stylesheet" href="{{ URL::asset('css/global.css') }}">

    </head>

    <body>


    <header>
        @include('layouts.navigation')    
    </header>

        <h1> title </h1>
        <div class="container">
    
            @if(Session::has('message'))
                <p class="message {{ Session::get('message-class') }}">{{ Session::get('message') }}</p>
            @endif

			<section>
		 		@yield('content')
			</section>
		</div>
  

    </body>
</html>