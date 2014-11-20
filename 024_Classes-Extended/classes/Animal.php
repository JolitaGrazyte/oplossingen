<?php 
//creating a class
class Animal{

	//creating properties
	protected $name;
	protected $gender;
	protected $health;

	public function __construct ($name, $gender, $health) {
        //echo "Animal Class init'ed successfuly!!!";
        $this->name = $name;
        $this->gender = $gender;
        $this->health = $health;

	}

	public function getName(){
		return $this->name;

	}
	public function getGender(){
		return $this->gender;

	}
	public function getHealth(){
		return $this->health;

	}
	public function changeHealth($health){
		return $this->health+$health;

	}
	public function doSpecialMove(){
		return 'walk';
	}

}

 ?>
