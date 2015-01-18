<?php 

/**
*  BASE CONTROLLER
*/
class Controller {
	
	function __construct()
	{
		Session::init();

		$this->view = new View();

		$this->messages = new Message();

	}
 
	/* voor App class
	public function model( $model ){
	
		$models_path = APP_FOLDER.'models'. DIRECTORY_SEPARATOR .$name.'_model.php';

		if ( file_exists( $models_path )) {
			
			require_once APP_FOLDER.'models/'.$model.'_model.php';

			$modelName = $model . '_Model';
			
			$this->model = new $modelName();

		}
	}
*/

	public function loadModel( $name ){
		
		$models_path = APP_FOLDER.'models'. DIRECTORY_SEPARATOR .$name.'_model.php';

		if ( file_exists( $models_path )) {
			
			require_once APP_FOLDER.'models/'.$name.'_model.php';

			$modelName = $name . '_Model';
			
			$this->model = new $modelName();
		}

	}
}

 ?>