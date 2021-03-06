<?php 

session_start(); 

function __autoload( $classname ) {
    include_once ('./classes/'. $classname .'.php');
}

$msqlConn = new MsqlConnect( 'file_upload', 'jolita', 'zN6br4fLYVJ8pSNy');

$artikels = Artikels::getArtikels( $msqlConn );
$artikelID = isset($_GET['artikel']) ? $_GET['artikel'] : '';

$idToUpdate = $artikels[$artikelID]['id'];


try {

		$queryStr = 'UPDATE artikels

             		 SET    is_active 	= (1 - is_active)

             		 WHERE  id = :artikelID';

		$valToBind = array(':artikelID' => $idToUpdate);

		$isUpdated = $msqlConn->update( $queryStr, $valToBind );

	if ($isUpdated[0]) {
    
    	Message::setMessage ( "Het artikel met id werd succesvol geactiveerd.", 'success' );
    	Header('Location: artikels-overzicht.php');
	}
	else{
    
    	Message::setMessage ( "Het artikel kon niet niet geactiveerd worden.".$isUpdated[1], 'error' );
    	Header('Location: artikels-overzicht.php');
            
	}

	
} catch (PDOException $e) {
	 	$message = 'Connectie met database is niet gelukt. '.$e->getMessage();
        
        Message::setMessage($message, 'error');
	
}
 ?>