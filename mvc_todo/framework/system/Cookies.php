<?php 

/**
* 
*/

class Cookies{

	public static function set( $name, $val, $time )
	{
		$cookie = setCookie( $name, $val, time()+$time, '/');

		return $cookie;
	}
	
	public static function get( $key )
	{
		if (isset( $_COOKIE[ $key ]) )
			
		return $_COOKIE[ $key ];
	}
	

	public static function logout( $name ){

		$unsetCookie = setCookie( $name, '', 0, '/');

	return $unsetCookie;

	}
}

 ?>