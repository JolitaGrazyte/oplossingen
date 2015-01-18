<?php

class Session
{
	
	public static function init()
	{
		session_start();
	}
	
	public static function set( $key, $email, $uid )
	{
		$_SESSION[ $key ][ 'email' ] = $email;

		$_SESSION [ $key ][ 'uid' ] = $uid;
	}
	
	public static function get( $key )
	{
		if (isset( $_SESSION[ $key ]) )
			
		return $_SESSION[ $key ];
	}
	
	public static function destroy()
	{
		session_destroy();
	}
	
}