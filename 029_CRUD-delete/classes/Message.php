<?php

	class Message
	{
		public static function setMessage( $text, $type )
		{
			$message[ 'text' ]		=	$text;
			$message[ 'type' ]		=	$type;

			$_SESSION['messages'][]	=	$message;
		}

		public static function getMessages()
		{
			$messages =	isset( $_SESSION['messages'] ) ? $_SESSION[ 'messages' ] : false;

			return $messages;
		}

	}

?>