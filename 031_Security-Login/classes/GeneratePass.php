<?php 

class GeneratePass{

 	public static function generatePassword($length){

    	$chars =    'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.
                '0123456789``-=~!@#$%^&*()_+,./<>?;:[]{}\|';
    
    	$max = strlen($chars) - 1; 
    	$generatedPassword = '';

 		for ($i=0; $i < $length; $i++)
    	
    	$generatedPassword .= $chars[rand(0, $max)];

    return $generatedPassword;
	
	}

}

?>