<?php 

/**
* 
*/
class Bootstrap {
	
	function __construct(){
		
		if ( isset($_GET['url'])) {
	
			$urlTrim = trim($_GET['url'], '/');

			$url = explode ( '/',  $urlTrim) ;
		}

		if ( empty( $url[0] )) {

			require_once APP_FOLDER.'controllers/home.php';

			$controller = new Home();

			$controller->index();

			return false;
		}

		$file = APP_FOLDER.'controllers/'. $url[0] . '.php';

		if ( file_exists( $file )) {

			require_once $file;
		}
		
		else {

			$this->error();

			return false;
		}
	
		$controller = new $url[0];
			
		$controller->loadModel( $url[0] );
		
		if (isset($url[2])) {
				
			if (method_exists($controller, $url[1])) {

				$controller->{$url[1]}($url[2]);
			
			} 	
			else {

				$this->error();

			}

		} 
		elseif ( isset($url[1]) ) {

			if ( method_exists($controller, $url[1]) ) {

				$controller->{$url[1]}();

			} 
			else {

				$this->error();

			}

		} 
		else {

			$controller->index();

		}
	
	}
	
	function error() {

		require APP_FOLDER.'controllers/error.php';

		$controller = new Error();

		$controller->index();
		
		return false;
	}
}

 ?>