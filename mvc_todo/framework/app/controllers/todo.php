<?php 

/**
* 
*/
class Todo extends Controller{
	
	function __construct()
	{
		parent::__construct();

		$this->view->voegToe = false;
	}

	public function index(){

		// get Todos of a certain user
		$this->view->todosArr = $this->model->getTodos();

		// get Dones of a certain user
		$this->view->doneArr = $this->model->getDone();

		// get message from Message class
		$this->view->msg = $this->messages->getMessages();

		$this->view->show('todo/index');

	}

	public function addTodo(){

		$this->view->voegToe = true;

		$this->view->show('todo/index');

	}

	public function addTodoProcess(){

		$args = $_POST['addTodo'];
		$uid  = $_POST['user_token'];

		if ( isset( $uid ) ) {

			if ( !empty( $uid )) {
				
				if ( empty( $args ) ) {

					$this->messages->setMessage( 'Lege todos niet toegestaan.', 'error' );
				}

				else {

					$this->model->addTodo( $args, $uid );

					$this->messages->setMessage( 'Todo is toegevoegd.', 'success' ); 
				}

				header('location:'. URL.'/todo');
			}
			else {
			
				$this->messages->setMessage( 'Je moet zich eerst inloggen!', 'error' );
			
				header('location:'. URL.'/login');
			}
		}
		
		
		
	}

	public function toggleStatus( $args ){

		$this->model->toggleStatus( $args );

		$this->messages->setMessage( 'job status changed', "success" );

		header('location:'. URL.'/todo');

	}
	public function deleteTodo( $args ){

		$this->model->deleteTodo( $args );

		$this->messages->setMessage( 'job status changed', "success" );

		header('location:'. URL.'/todo');

	}

}

 ?>