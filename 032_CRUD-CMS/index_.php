<?php 
session_start();

function __autoload($classname) {
    include_once ('./classes/'. $classname .'.php');
}

//__variables__//

$email   = isset( $_SESSION['registratie']['email'] ) ? $_SESSION['registratie']['email'] : '';
$pass    = isset( $_SESSION['registratie']['pass'] )  ? $_SESSION['registratie']['pass']  : '';



//___BUILD HTML___//
$pages = array('registratie_form', 'dashboard');
$title = array('Registreren', 'Dashboard');

if (isset( $_GET['page'] ) ? $_GET['page'] : 'registratie-form') {
    $title   = 'Registreren';
}
elseif (isset( $_GET['page'] ) ? $_GET['page'] : 'dashboard') {
    $title   = 'Dashboard';
}


if (isset( $_GET['page'] ) ? $_GET['page'] : 'index') {
    $body   = (isset( $_GET['page'] ) ? $_GET['page'] : 'registratie-form') . '.php';
}
else {
    foreach ($pages as $page) {
        $body   = (isset( $_GET['page'] ) ? $_GET['page'] : $page) . '.php';
    }
}


$headerArr = array( 'link' => 'header.php',
                    'data' =>  array(   'title' => 'Security Login' ) );

$bodyArr = array(   'link' =>  $body,
                    'data' =>  array(   'title'     => $title,
                                        'pass'      => $pass,
                                        'email'     => $email,
                                        'messages'  => Message::getMessages()
                            		)
                );

$footerArr = array( 'link' => 'footer.html',
                    'data' => array(    'footerInfo' => 'Jolita Grazyte') );

$page = new View($headerArr, $bodyArr, $footerArr);


 ?>