<?php

function __autoload($classname) {
    include_once ('./classes/'. $classname .'.php');
}

$pages = array('works', 'contact');

if (isset( $_GET['page'] ) ? $_GET['page'] : 'index') {
	$body 	= (isset( $_GET['page'] ) ? $_GET['page'] : 'index') . '.partial.html';
}
else {
	foreach ($pages as $page) {
		$body 	= (isset( $_GET['page'] ) ? $_GET['page'] : $page) . '.partial.html';
	}
}


$page = new HTMLBuilder('header.partial.html', $body, 'footer.partial.html');


?>