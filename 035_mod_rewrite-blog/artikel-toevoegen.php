<?php 

session_start();

function __autoload($classname) {
    include_once ('./classes/'. $classname .'.php');
}

$datum = false;
$timestamp = false;

if (isset($_POST['submit'])) {

	$leeg = (empty($_POST['title']) || empty($_POST['artikel']) || empty($_POST['kernwoorden']) );

	if($leeg){

		Message::setMessage ( "Het artikel kon niet toegevoegd worden. Een van de velden is leeg.", 'error' );
		Header('Location: http://oplossingen.web-backend.local/035_mod_rewrite-blog/toevoegen/');


	}
	else{
			
			// $_SESSION['timestamp'] = $timestamp;

			$timestamp = mktime( $_POST['date'] );
			$datum = date("Y-m-j, g:i:s", $timestamp);
			$_SESSION['datum'] = $datum;

			$valToBind = array(	
	
							':title' 		=> $_POST['title'], 
							':artikel' 		=> $_POST['artikel'], 
							':kernwoorden' 	=> $_POST['kernwoorden'],
							':datum'		=> $datum
						);
			

		try {

			$msqlConn = new MsqlConnect( 'mod_rewrite', 'jolita', 'zN6br4fLYVJ8pSNy');

            $isSubmited = Artikels::createArtikel( $msqlConn, $valToBind );
    
            if ( $isSubmited[0] ) {
    
                Message::setMessage ( "Het artikel werd succesvol toegevoegd.", 'success' );
                Header('Location: http://oplossingen.web-backend.local/035_mod_rewrite-blog/artikels/');
            }
            else{
    
                Message::setMessage ( "Het artikel kon niet toegevoegd worden.".$isSubmited[1], 'error' );
                Header('Location: http://oplossingen.web-backend.local/035_mod_rewrite-blog/toevoegen/');
            
            }

            
        } 
        catch (PDOException $e) {
            $message = 'Connectie met database is niet gelukt. '.$e->getMessage();
        
            Message::setMessage($message, 'error');
        }

	}

}


 ?>