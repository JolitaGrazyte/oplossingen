<?php 

/**
* 
*/
class Register extends Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index(){

		$this->view->msg = $this->model->message();
		
		$this->view->show('register/index');

	}

	public function register(){

		$isEmailValid = filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ? true : false;

		if ( $isEmailValid ) {

			$this->model->createUser( $_POST['email'],  $_POST['pass'] );
		}
		
	}
}

 ?>