<?php
class MsqlConnect
{

    private $msqlLink;

    public function __construct($db, $user, $pass){
        
        $host = 'mysql:host=localhost;dbname=';
        
        $this->msqlLink = new PDO($host.$db, $user, $pass);

    }

    //___SELECT___//
    public function query( $queryString, $valuesToBind ){

        $statement = $this->msqlLink->prepare( $queryString );
        
        foreach ($valuesToBind as $key => $value) {
            $statement->bindParam( $key, $value );
        }

        $statement->execute();

        return $this->fetchResult( $statement );
    }

    public function fetchResult( $statement ){
        
        $fetchRow = array();

        $colNames = false;

        while ( $row = $statement->fetch( PDO::FETCH_ASSOC) )
        {
            $fetchRow[] = $row;

            $colNames = array();

            foreach ($fetchRow[0] as $key => $value) 
            {
                $colNames[] = $key;
            }

        }

        $result = array('colNames' => $colNames, 'data' => $fetchRow);
        
        return $result;
    }


    //__INSERT, UPDATE, DELETE__//
     public function update( $queryString, $valuesToBind ){

        $statement = $this->msqlLink->prepare( $queryString );

        $isSubmited = $statement->execute( $valuesToBind );
        
        $results = array( $isSubmited, $statement->errorInfo()[2] ); 

        return $results;

    }

}
?>