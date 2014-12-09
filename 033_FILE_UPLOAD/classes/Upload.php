<?php 

class Upload{

	public static function validateFile( $file ){

		$fileTypeArr = array( 'image/gif', 'image/jpeg', 'image/png' );

		$validFile = in_array( $file['type'], $fileTypeArr);

		if ( $validFile && $file['size'] < 2000000 ) {

			$noError = self::checkForErrors( $file['error'] );

			if ( $noError ) {

				return true;
			} 
			
		}

		return false;

	}

	public static function checkForErrors( $fileErrors ){

		if ( !isset( $fileErrors ) || is_array( $fileErrors ) ) {
        	
        	throw new RuntimeException('Invalid parameters.');
        }

		elseif ( $fileErrors > 0) {
	
			// throw new RuntimeException( "Return Code: " . $_FILES["file"]["error"] );
			$message = new RuntimeException( 'Return Code: ' . $fileErrors );
			Message::setMessage($message, 'error');

		}
		else return true;
	}

	public static function saveFileToDB(){


	}

}

 ?>