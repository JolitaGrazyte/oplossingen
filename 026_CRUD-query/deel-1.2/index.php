<?php 

    include_once ('../classes/HTMLBuilder.php');
    include_once ('../classes/Message.php');
    include_once ('MsqlConnect.php');

$valuesToBind = array(':bierNaam' => 'du%',':brouwerNaam' => '%a%');

$message = '';
//$messageStatus = false;

try {
	$queryString = 'SELECT  *
					FROM bieren
					INNER JOIN brouwers
					ON bieren.brouwernr = brouwers.brouwernr
					WHERE bieren.naam LIKE :bierNaam
                    AND brouwers.brnaam LIKE :brouwerNaam';

$msqlConn = new MsqlConnect('bieren', 'jolita', 'zN6br4fLYVJ8pSNy', $queryString);

$bierenArray = $msqlConn->query($queryString, $valuesToBind);

Message::setMessage( 'Successfully connected to database! ' , 'success');

} 

catch (PDOException $e) {
	
    $message = 'Sorry, failed! '.$e->getMessage();
    
    Message::setMessage($message, 'error');
	
}


$headerArr = array('link' => 'header.view.php',
                             'data' => array('title' => 'CRUD query'));

$bodyArr = array('link' =>  'index.view.php',
                            'data' => array('title' => 'CRUD query', 
                            'messages' => Message::getMessages(), 

                            'thead' => $bierenArray[0], 
                            'bieren' => $bierenArray[1]));

$footerArr = array('link' => 'footer.view.html',
                             'data' => array('info' => 'Jolita Grazyte'));

$page = new HTMLBuilder($headerArr, $bodyArr, $footerArr);


 ?>
 