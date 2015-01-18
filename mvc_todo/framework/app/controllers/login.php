<?php 

/**
* 
*/
class Login extends Controller{
	
	function __construct()
	{
		parent::__construct();

	}
	public function index(){

		$this->view->msg = $this->messages->getMessages();

		$this->view->title = "LOGIN";

		$this->view->show('login/index');

	}

	public function login(){

		$isEmailValid = filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ? true : false;

		if ( $isEmailValid ) {

			$this->model->login( $_POST['email'] );

		}
		else header('location: ../login');

	}
}


 ?>