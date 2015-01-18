<?php 

/**
* 
*/
class App
{
	protected $controller = 'home';

	protected $method = 'index';

	protected $params = [];

	public function __construct(  )
	{
		//echo 'HELLO from APP class!';

		//print_r ( $this->parseUrl() );

		$url = $this->parseUrl();

		//print_r($url);

		if ( file_exists( APP_FOLDER.'controllers/' . $url[0] . '.php' )) {
			
			$this->controller = $url[0];
			unset( $url[0] );

		}

		require_once APP_FOLDER.'controllers/' . $this->controller . '.php';
		
		$this->controller = new $this->controller;
		//var_dump($this->controller);

		if ( isset( $url[1] ) ) {
			if ( method_exists( $this->controller, $url[1] ) ) {
				
				$this->method = $url[1];
				unset( $url[1] );

			}

		}

		$this->params = $url ? array_values( $url ) : [];
		//print_r($this->params);
		call_user_func_array( [$this->controller, $this->method], $this->params );
	}

	public function parseUrl(){

		if ( isset($_GET['url']) ){

			//echo $_GET['url'];

			$getUrl = rtrim( $_GET['url'], '/' );

			$sanitize = filter_var( $getUrl, FILTER_SANITIZE_URL );

			return $url = explode( '/', $sanitize ) ;
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