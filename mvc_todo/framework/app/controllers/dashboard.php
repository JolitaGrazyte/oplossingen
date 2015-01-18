<?php 

/**
* 
*/
class Dashboard extends Controller
{
	
	function __construct() {

		parent::__construct();

		$logged = Cookies::get('login');

		if ( $logged == false ) {

			Session::destroy();

			header('location:'.URL.'/login');

			exit;
		}
	}
	
	function index() {	

		$this->loggedIn = true; 

		$this->view->msg = "Welcome to DASHBOARD";

		$this->view->link = URL.'/todo';

		$this->view->show('dashboard/index');
	}
	
	function logout(){

		Session::destroy();

		Cookies::logout('login');

		header('location:'.URL.'/home');
	
		exit;
	}

	
}

 ?>