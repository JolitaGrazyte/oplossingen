<?php 


session_start();

function __autoload( $classname ) {
    include_once ('./classes/'. $classname .'.php');
}

$isEmailValid = filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ? true : false;

if ( isset($_POST['submit']) ) {

	$email = $_POST['email'];
	$pass  = $_POST['password'];

	$_SESSION[ 'login' ][ 'email' ]		=	$email;
	$_SESSION[ 'login' ][ 'password' ]	=	$pass;

	if ( $isEmailValid && !empty( $pass )) {

		//___make connection to database___//
        $msqlConn = new MsqlConnect( 'login', 'jolita', 'zN6br4fLYVJ8pSNy' );

        $loggedIn = User::validateLogin( $msqlConn, $email, $pass );

		if ( $loggedIn ) {

			Message::setMessage('U bent ingelogd.', 'success'); 
			Header('Location: dashboard.php');

		}
		else{

		Message::setMessage('Er ging iets mis. Probeer opnieuw.', 'error');
		Header('Location: login-form.php');
		}
	
	}
	else{

		Message::setMessage('Dit is geen geldig e-mailadres. Vul een geldig e-mailadres in.', 'error');
		Header('Location: login-form.php');

	}


	
}

		

 ?>