<?php 

/**
* 
*/
class View{
	
	function __construct()
	{

	}

	public function  show( $name ){

		$this->loggedIn = isset( $_SESSION['login'] ) ? true : false;

		$this->email = isset($_SESSION['login']['email']) ? $_SESSION['login']['email'] : '';

		$this->uid = isset($_SESSION['login']['uid']) ? $_SESSION['login']['uid'] : '';

		require_once APP_FOLDER.'views/header.php';

		require_once APP_FOLDER.'views/'. $name .'.php';
		
		require_once APP_FOLDER.'views/footer.php';
	}

}


 ?>