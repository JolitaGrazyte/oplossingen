<?php


/**
* 
*/
class Todo extends Eloquent{
	
	protected $fillable = array('name', 'status', 'archived', 'user_id', 'created_at' );

	public function toggleStatus(){

		$this->status = $this->status ? 0 : 1;

		$this->save();
	}

	public function delete(){

		$this->archived = $this->archived ? 0 : 1;

		$this->save();
	}
	
}