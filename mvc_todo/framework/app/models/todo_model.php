<?php 

/**
* 
*/
class Todo_Model extends Model
{
	private $uid;
	private $bindValues;
	
	function __construct()
	{
		parent::__construct();

		$this->uid = isset( $_SESSION['login']['uid'] ) ? $_SESSION['login']['uid'] : '';

		$this->bindValues	=	false;
	}

	public function message(){

		return "i'm a Todo App";
		
	}

	public function addTodo( $todo, $uid ){

		if ( !empty( $todo ) && !empty( $uid ) ) {
			
			$bindValues	=	false;

			$query 		=	'INSERT INTO todos ( name, created_at, uid )
							 VALUES ( :todo, NOW(), :uid )';

			$bindValues	=	array( ':todo' => $todo, ':uid' =>  $this->uid );

			$this->query( $query, $bindValues );

		}
		else {
			Message::setMessage( 'lege todos niet toegestaan' ,'error');
		}	
		
	}

	public function getTodos(){

		$todosAarray = array();

		$query 		=	'SELECT * FROM todos WHERE uid = :uid AND status = 1 AND archived = 0';

		$this->bindValues	=	array( ':uid' =>  $this->uid );

		$todosAarray = $this->query( $query, $this->bindValues );

		return $todosAarray['data'];

	}

	public function getDone(){

		$doneAarray = array();

		$query 		=	'SELECT * FROM todos WHERE uid = :uid AND status = 0 AND archived = 0';

		$this->bindValues	=	array( ':uid' =>  $this->uid );

		$doneAarray = $this->query( $query, $this->bindValues );

		return $doneAarray['data'];
		
	}

	public function toggleStatus( $todoID ){

		$query 		=	'UPDATE todos SET status = (1-status) WHERE uid = :uid AND id = :id';  

		$this->bindValues	=	array( ':uid' =>  $this->uid, ':id' => $todoID );

		$doneAarray = $this->query( $query, $this->bindValues );
		
	}
	public function deleteTodo( $todoID ){

		$query 		=	'UPDATE todos SET archived = 1 WHERE uid = :uid AND id = :id';  

		$this->bindValues	=	array( ':uid' =>  $this->uid, ':id' => $todoID );

		$doneAarray = $this->query( $query, $this->bindValues );
		
	}
}


 ?>