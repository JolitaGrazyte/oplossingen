<?php 
//creating a class
class Percent{

	//creating properties
	public $absolute;
	public $relative;
	public $hundred;
	public $nominal;

	public function __construct ($new, $unit) {
        //echo "Percent Class init'ed successfuly!!!";	

		$this->absolute = $new/$unit;
		$this->relative = $this->absolute - 1;
		$this->hundred = $this->relative * 100;
		
		if ($this->absolute > 1) {
			$this->nominal = 'positive';
		}
		elseif ($this->absolute == 1) {
			$this->nominal = 'status-quo';
		}
		else $this->nominal = 'negative';
		
	}

	public function formatNumber($number){
		return number_format($number, 2, '.', '');

	}

}

 ?>
