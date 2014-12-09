	<?php 
session_start();

function __autoload($classname) {
    include_once ('./classes/'. $classname .'.php');
}

if ( isset( $_POST['submit'] ) ) {
	$userEmail = $_POST['email'];
	$_SESSION['file'] = $_FILES['file'];

	try {

		//__controle op type, grote en fouten van file uitvoeren__//
		$geldigFile = Upload::validateFile( $_FILES['file']);

	
		if ( $geldigFile ) {

			// __FILE__ is dit bestand
			// define ROOT van dit bestand
			define('ROOT', dirname(__FILE__));
			$filename = time().'_'. $_FILES['file']['name'];

			//controleer of file nog niet bestaat
			if ( file_exists( ROOT . '/img/' . $filename ) ) {
					
				throw new RuntimeException( $filename . ' bestaat al. ' );
				$filename = time().'_'. $_FILES['file']['name'];

			}
			else{

				// Anders mag het bestand geüpload worden naar de map
				move_uploaded_file( $_FILES['file']['tmp_name'], ( ROOT.'/img/'.$filename ) );

			} 
			
			$msqlConn = new MsqlConnect( 'file_upload', 'jolita', 'zN6br4fLYVJ8pSNy');

			$queryStr = 'UPDATE users
						 SET 	profile_picture = :img_file
						 WHERE 	email = :email';

			$valToBind = array(	':img_file' => $filename, ':email' => $userEmail );
	
			$isSubmited = $msqlConn->update( $queryStr, $valToBind);

			if ( $isSubmited[0] ) {

				$queryStr = 'SELECT profile_picture 
							 FROM 	users
						 	 WHERE 	email = :email';

				$paramToBind = array( ':email' => $userEmail );
				$getProfileImg = $msqlConn->query( $queryStr, $paramToBind);

				$_SESSION['profileImg'] = 'img/'.$getProfileImg['data'][0]['profile_picture'];

				header('Location: gegevens-wijzigen-form.php');
				Message::setMessage('File ' . $_FILES["file"]["name"].' succesvol geüpload. ', 'success');
				//Message::setMessage('Type: ' . $_FILES["file"]["type"], 'success');
				//Message::setMessage('Size: ' . $_FILES["file"]["size"] / 1024, 'success');
				//Message::setMessage('Temp file: ' . $_FILES["file"]["tmp_name"], 'success');
				//Message::setMessage('Opgeslagen in: ' . ROOT . "/img/" . $_FILES["file"]["name"], 'success');

			}
			else{

				Message::setMessage( $isSubmited[1], 'error');
			}

	}
	else {
		// throw new RuntimeException(  'Ongeldig bestand' );
		$message = new RuntimeException( 'Ongeldig bestand' );
		Message::setMessage($message, 'error');
		header( 'Location: gegevens-wijzigen-form.php' );
	}
	
} catch (RuntimeException $e) {

	echo $e->getMessage();	
}


}


 ?>