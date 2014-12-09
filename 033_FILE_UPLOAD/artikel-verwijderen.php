<?php 

session_start(); 

function __autoload($classname) {
    include_once ('./classes/'. $classname .'.php');
}

$msqlConn = new MsqlConnect( 'file_upload', 'jolita', 'zN6br4fLYVJ8pSNy');

$artikels = Artikels::getArtikels( $msqlConn );
$artikelID = isset($_GET['artikel']) ? $_GET['artikel'] : '';

$idToArchive = $artikels[$artikelID]['id'];

try {

	$queryStr = 'UPDATE artikels

             	 SET    is_archived = 1

             	 WHERE  id 			= :artikelID';

	$valToBind = array(':artikelID' => $idToArchive);

	$isUpdated = $msqlConn->update( $queryStr, $valToBind );

	if ($isUpdated[0]) {
    
    	Message::setMessage ( "Het artikel werd succesvol verwijderd.", 'success' );
    	Header('Location: artikels-overzicht.php');
	}
	else{
    
    	Message::setMessage ( "Het artikel kon niet niet verwijderd worden.".$isUpdated[1], 'error' );
    	Header('Location: artikels-overzicht.php');
            
	}
	
} catch (PDOException $e) {

		$message = 'Connectie met database is niet gelukt. '.$e->getMessage();
        
        Message::setMessage($message, 'error');
	
}
 ?>