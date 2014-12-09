<?php 


session_start();

function __autoload($classname) {
    include_once ('./classes/'. $classname .'.php');
}	
	$uitgelogged = User::logout();

	if ($uitgelogged) {
		Message::setMessage('U bent uitgelogd. Tot de volgende keer.', 'success');
        Header('Location: login-form.php');   
	}
    	

 ?>