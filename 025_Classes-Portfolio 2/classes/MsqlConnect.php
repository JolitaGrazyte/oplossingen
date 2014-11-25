<?php
class MsqlConnect
{

    private $msqlConn;
    private $statement;

    public function __construct($db, $user, $pass, $queryString, $val){
            
            $host = 'mysql:host=localhost;dbname=';

        try {
            $this->msqlConn = new PDO($host.$db, $user, $pass);
            
            $this->statement($queryString, $val);
            
            Message::setMessage( 'Successfully connected to database! ' , 'success');
            
        }
        catch ( PDOException $e ){

            $message = 'Ahh, damn. Connection failed! '.$e->getMessage();
            
            Message::setMessage($message, 'error');
        }
    }

    public function statement($queryString, $val){

            $this->statement = $this->msqlConn->prepare($queryString);

            $this->statement->bindValue(':val', $val);
        
            $this->statement->execute();
    }

    public function getResult(){
        
            $getRow = array();

            $getColNames = array();

        //__get all results__//
        while ( $row = $this->statement->fetch(PDO::FETCH_ASSOC))
        {
            $getRow[] = $row;

            //__get column name__//
            foreach ($getRow[0] as $key => $value) 
            {
                $getColNames[] = $key;
            }

        }

            $result = array();
            $result[] = $getColNames;
            $result[] = $getRow;
        
            return $result;
        //return $fetchRow;
    }

}
?>