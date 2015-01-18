<?php 

/**
* 
*/
class Message
{
	
	function __construct()
	{
		# code...
	}

	public function setMessage( $text, $type )
		{
			$message[ 'text' ]		=	$text;
			$message[ 'type' ]		=	$type;

			$_SESSION['messages'][]	=	$message;
		}

		public function getMessages()
		{

			$messages	=	false;

			if ( isset( $_SESSION['messages'] ) )
			{
				$messages	=	$_SESSION[ 'messages' ];
				unset( $_SESSION[ 'messages' ] );
			}
			
			return $messages;

		}
}


 ?>