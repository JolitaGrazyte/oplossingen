<?php 

/**
* 
*/
class Error extends Controller{
	
	function __construct()
	{
		parent::__construct();
	}

	function index(){

		$this->messages->setMessage( "Soorry, deze pagina bestaat niet !! ", "error" );

		$this->view->msg = $this->messages->getMessages();

		$this->view->show('error/index');
	}
}

 ?>