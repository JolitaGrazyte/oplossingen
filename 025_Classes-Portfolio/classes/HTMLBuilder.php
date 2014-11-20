<?php 

class HTMLBuilder{
	
	//varibales = parts of html
	protected $header;
	protected $body;
	protected $footer;
	protected $title;
	protected $nav

	public function __construct($header, $body, $footer, $title, $nav){
		$this->header = $header;
		$this->body   = $body;
		$this->footer = $footer;
		$this->title  = $title;
		$this->nav    = $nav;

		//build the page
		$this->buildPage();
	}

	public function buildHeader(){
		view($this->header, array( 'title' 	=> $this->title,
								   'nav'	=> $this->nav ));
		//include 'html/'.$this->header;

	}

	public function buildBody(){
		//include ('html/'.$this->body);
		view($this->body, array( 'messages' 	=> 	Message::getMessages() ));
		
	}

	public function buildFooter(){
		//include ('html/'.$this->footer);
		view( $this->footer );
	}


	function view( $file, $data = false )
	{
		if ( $data )
		{
			$data = extract( $data );
		} 

		include( '/html/'.$file );
		return $data;
	}


	public function buildPage(){

		$this->buildHeader();
		$this->buildBody();
		$this->buildFooter();

	}

}

?>