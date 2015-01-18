<?php 

/**
* 
*/
class Model{
	
	protected $db;

	public function __construct()
	{
		$this->db = new Database();
	}

	public function query( $query, $tokens = false ){
			
		$statement = $this->db->prepare( $query );
			
		if ( $tokens ){
				
			foreach ( $tokens as $token => $tokenValue ){
					
					$statement->bindValue( $token, $tokenValue );
				}
		}

		$statement->execute();

		/*___FIELDNAMES___*/
		$fieldnames	=	array();

		for ( $fieldNumber = 0; $fieldNumber < $statement->columnCount(); ++$fieldNumber ){
			
			$fieldnames[]	=	$statement->getColumnMeta( $fieldNumber )['name'];
		}

		
		/*__DATA__*/
		$data	=	array();

		while( $row = $statement->fetch( PDO::FETCH_ASSOC ) ){
			$data[]	=	$row;
		}

		$returnArray['fieldnames']	=	$fieldnames;
		$returnArray['data']		=	$data;

		return $returnArray;
	}
}
 ?>