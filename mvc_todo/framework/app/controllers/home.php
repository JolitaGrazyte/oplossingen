<?php 

/**
* 
*/
class Home extends Controller{
	
	function __construct()
	{
		parent::__construct();
		//echo "We are at home </br>";
	}

	public function index( $args = '' ){

		$this->view->title = "HOME";

		$this->view->show('home/index');

		
	}

}

 ?>