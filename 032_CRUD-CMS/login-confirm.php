<?php 


session_start();

function __autoload($classname) {
    include_once ('./classes/'. $classname .'.php');
}


$email   = isset( $_SESSION['registratie']['email'] ) ? $_SESSION['registratie']['email'] : '';
$pass    = isset( $_SESSION['registratie']['pass'] )  ? $_SESSION['registratie']['pass']  : '';

if (isset($_POST['submit'])) {

	if (User::authenticate()) {
		Message::setMessage('U bent ingelogd.', 'success'); 
		Header('Location: dashboard.php');
	}
	else{
		Message::setMessage('Er ging iets mis. Probeer opnieuw.', 'error');
		Header('Location: login-form.php');
	}
}




 ?>