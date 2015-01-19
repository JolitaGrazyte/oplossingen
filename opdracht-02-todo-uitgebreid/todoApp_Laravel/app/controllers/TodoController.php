<?php


class TodoController extends BaseController {
	
	public function getIndex(){

		if ( Auth::check() ) {

			$todos = Auth::user()
					->todos()
					->where( 'status', '=', 0)
					->where( 'archived', '=', 0 )
					->get();

			$dones = Auth::user()
					->todos()
					->where( 'status', '=', 1)
					->where( 'archived', '=', 0 )
					->get();

			$todosArr = $todos->toArray();
			$donesArr = $dones->toArray();

		return View::make('todo.index')->with( array(

			'title' => 'Todo App',
			'todos' => $todosArr,
			'dones' => $donesArr
			
		));
			
		}

		return $this->redirectToLogin();
		
	}

	public function getAdd(){

		if ( Auth::check()) {

			return View::make('todo.add', array(

				'title' => 'Todo App'
		
			));
		}

		return $this->redirectToLogin();

	}

	public function delete( $id ){

		$todo = Todo::findOrFail( $id );

		$todo->delete();	

		return Redirect::route('todo')
				->with( 
							Session::flash('message', '"'.$todo->name.'" werd verwijderd.'), 
							Session::flash('message-class', 'success') 
						);

	}

	public function changeStatus( $id ){

		$todo = Todo::findOrFail( $id );

		$todo->toggleStatus();

		$status = $todo->status;

		$msg = ( $status == 0 ) ? 'Ai ai, nog meer werk...' : 'Alright! Dat is geschrapt.';


		return Redirect::route('todo')
					->with( 
							Session::flash('message', $msg ), 
							Session::flash('message-class', 'success') 
						);

	}

	public function postTodo(){

		if ( Auth::check() ) {

			$uid = Auth::id();
		}

		else{

			return $this->redirectToLogin();
		}
		

		$validator = Validator::make( Input::all(), 
			array( 'todo' 	=> 'required' ));

		if ( $validator->fails() ) {
			//die('Failed!');

			return Redirect::route('todo-add')
		 			->with( 
							Session::flash('inputerror', 'Hmm, iets vergeten in te vullen?'), 
							Session::flash('message-class', 'inputerror') 
					);
		}
		else{

			$todos = array( array(
				
				'name' 			=> Input::get('todo'),
				'created_at'	=> date("Y-m-d H:i:s"),
				'user_id' 		=> $uid
				
				));

			$success = DB::table('todos')->insert($todos);

			if ( $success ) {

				return Redirect::route('todo')
					->with( 
							Session::flash('message', 'Todo "'.Input::get('todo').'" toegevoegd.'), 
							Session::flash('message-class', 'success') 
					);
			}
			else{

				return Redirect::route('todo')
					->with( 
							Session::flash('message', 'Er iets mis gegaan. "'.Input::get('todo').'" kon niet toegevoegd worden.'), 
							Session::flash('message-class', 'error') 
					);

			}
		}

	}

	protected function redirectToLogin(){

		return Redirect::route('login')
			->with( 
				Session::flash('message', 'Eerst inloggen graag!'), 
				Session::flash('message-class', 'error') 
			);
	}

}
