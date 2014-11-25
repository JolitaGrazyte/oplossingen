<?php 

function __autoload($classname) {
    include_once ('../classes/'. $classname .'.php');
}

//___defining variables___//
$bierenArray     = array("","");
$selectedBrouwer = false;
$val             = 1;

try {
    $queryStr = 'SELECT brouwernr, brnaam
             FROM   brouwers
             WHERE  :val';

//___connecting to database___
$msqlConn = new MsqlConnect('bieren', 'jolita', 'zN6br4fLYVJ8pSNy', $queryStr);

//__fetching results and pushing in to array__//
$brouwersArray = $msqlConn->query($queryStr, $val);
  
        if (isset($_GET['brouwernr'])) {
  
            $selectQueryStr  = 'SELECT bieren.naam, brouwers.brnaam 
                                FROM  bieren
                                INNER JOIN brouwers
                                ON bieren.brouwernr = brouwers.brouwernr
                                WHERE bieren.brouwernr = :val';
            $bierenArray = $msqlConn->query($selectQueryStr, $_GET['brouwernr']);

            $selectedBrouwer =  true;
    }

    Message::setMessage( 'Successfully connected to database! ' , 'success');
    
} catch (PDOException $e) {
    $message = 'Connection failed! '.$e->getMessage();
    Message::setMessage($message, 'error');
    
}


$headerArr = array('link' => 'header.view.php',
                             'data' => array('title' => 'CRUD insert'));

$bodyArr = array('link'  =>  'index.view.php',
                             'data'         => array('title'        => 'CRUD insert', 
                                                     'messages'     => Message::getMessages(),
                                                     'bierenStatus' => $selectedBrouwer,
                                                     'brouwers'     => $brouwersArray[1], 
                                                     'bieren'       => $bierenArray[1]
                                                     )
                );

$footerArr = array('link' => 'footer.view.html',
                             'data' => array('info' => 'Jolita Grazyte'));

$page = new HTMLBuilder($headerArr, $bodyArr, $footerArr);

 ?>