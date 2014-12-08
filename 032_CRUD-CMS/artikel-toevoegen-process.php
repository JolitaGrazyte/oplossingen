<?php 

session_start();

function __autoload($classname) {
    include_once ('./classes/'. $classname .'.php');
}


if (isset($_POST['submit'])) {

	$leeg = (empty($_POST['title']) || empty($_POST['artikel']) || empty($_POST['kernwoorden']) );

	if($leeg){

		Message::setMessage ( "Het artikel kon niet toegevoegd worden. Een van de velden is leeg.", 'error' );
		Header('Location: artikel-toevoegen-form.php');


	}
	else{
	
			$valToBind = array(	
	
							':title' 		=> $_POST['title'], 
							':artikel' 		=> $_POST['artikel'], 
							':kernwoorden' 	=> $_POST['kernwoorden'],
							//':datum'		=> $_POST['date']
						);

			

		try {

			$msqlConn = new MsqlConnect( 'CRUD_CMS', 'jolita', 'zN6br4fLYVJ8pSNy');

            $isSubmited = Artikels::createArtikel( $msqlConn, $valToBind );
    
            if ($isSubmited[0]) {
    
                Message::setMessage ( "Het artikel werd succesvol toegevoegd.", 'success' );
                Header('Location: artikels-overzicht.php');
            }
            else{
    
                Message::setMessage ( "Het artikel kon niet toegevoegd worden.".$isSubmited[1], 'error' );
                Header('Location: artikel-toevoegen-form.php');
            
            }

            
        } 
        catch (PDOException $e) {
            $message = 'Connectie met database is niet gelukt. '.$e->getMessage();
        
            Message::setMessage($message, 'error');
        }

	}

}


 ?>