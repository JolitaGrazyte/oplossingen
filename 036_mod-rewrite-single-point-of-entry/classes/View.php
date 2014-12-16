<?php 

class View{

	//varibales = parts of html
	protected $header;
	protected $body;
	protected $footer;


	public function __construct($headerDataArr, $bodyDataArr, $footerDataArr){
		$this->header = array();
		foreach ($headerDataArr as $key => $value) {
			$this->header[$key] = $value;
		}
		foreach ($bodyDataArr as $key => $value) {
			$this->body[$key] = $value;
		}
		foreach ($footerDataArr as $key => $value) {
			$this->footer[$key] = $value;
		}

		//build the page
		$this->buildPage();
	}

	public function buildHeader(){
		// var_dump($this->header);
		$this->view($this->header['link'], $this->header['data']);

		
	}

	public function buildBody(){
		// var_dump($this->body);
		$this->view($this->body['link'], $this->body['data']);
		
		
	}

	public function buildFooter(){
		// var_dump($this->footer);
		$this->view($this->footer['link'], $this->footer['data']);
		
	}


	public function buildPage(){

		$this->buildHeader();
		$this->buildBody();
		$this->buildFooter();

	}

	public function view( $file, $data = false )
	{
		if ( $data )
		{
			extract( $data );
		} 

		include( 'html/'.$file );
	}

}


 ?>