<?php 
function __autoload($classname) {
    include_once './classes/'. $classname .'.php';
}
$val = 1;

$queryStr = 'SELECT * FROM `menu` WHERE :val';

$msqlConn = new MsqlConnect('jolitaTest', 'jolita', 'zN6br4fLYVJ8pSNy', $queryStr, $val);


$menu = $msqlConn->getResult();
//var_dump($menu[1]);

$nav = array();
foreach ($menu[1] as $value) {
	$nav[] = $value['name']; 
}

//$nav = array('home', 'works', 'contact');
$headerArr = array('link' => 'header.view.html',
							 'data' => array('title' => 'Jolita Grazyte', 'nav' => $nav, 
							 'messages' => Message::getMessages()));


if (isset( $_GET['page'] ) ? $_GET['page'] : 'index') {
	//$body 	= (isset( $_GET['page'] ) ? $_GET['page'] : 'index') . '.partial.html';
	$bodyArr = array('link' => (isset( $_GET['page'] ) ? $_GET['page'] : 'index') . '.partial.html',
						   'data' => array('bodyItem' => ''));
}
else {
	foreach ($nav as $page) {
		//$body 	= (isset( $_GET['page'] ) ? $_GET['page'] : $page) . '.partial.html';
		$bodyArr = array('link' => (isset( $_GET['page'] ) ? $_GET['page'] : $page) . '.partial.html',
						   'data' => array('bodyItem' => ''));
	}
}

$footerArr = array('link' => 'footer.view.html',
							 'data' => array('footerInfo' => 'Jolita Grazyte'));
$page = new HTMLBuilder($headerArr, $bodyArr, $footerArr);

?>
