<?php
class MsqlConnect
{

    private $msqlLink;

    public function __construct($db, $user, $pass, $queryString){
        
        $host = 'mysql:host=localhost;dbname=';
        
        $this->msqlLink = new PDO($host.$db, $user, $pass);

    }

    public function query($queryString, $valuesToBind){

        $statement = $this->msqlLink->prepare($queryString);

        $statement->execute($valuesToBind);

        return $this->fetchResult($statement);
    }


    public function insert_delete($queryString, $valuesToBind){

        $statement = $this->msqlLink->prepare($queryString);

        $isSubmited = $statement->execute($valuesToBind);

        $results = array($isSubmited, $statement->errorInfo()[2]);

        return $results;

    }

     public function update($queryString, $valuesToBind){

        $statement = $this->msqlLink->prepare($queryString);

        $isSubmited = $statement->execute($valuesToBind);

        $results = array($isSubmited, $statement->errorInfo()[2]);

        return $results;

    }


    public function fetchResult($statement){
        
        $fetchRow = array();

        while ( $row = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $fetchRow[] = $row;

            $colNames = array();

            foreach ($fetchRow[0] as $key => $value) 
            {
                $colNames[] = $key;
            }

        }

        $result = array($colNames, $fetchRow);
        
        return $result;
    }

}
?>