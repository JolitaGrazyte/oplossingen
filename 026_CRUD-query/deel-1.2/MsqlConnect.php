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

    public function fetchResult($statement){
        $fetchRow = array();

        while ( $row = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $fetchRow[] = $row;

             $theadArr = array();

            foreach ($fetchRow[0] as $key => $value) 
            {
                $theadArr[] = $key;
            }

        }

        $result = array();
        $result[] = $theadArr;
        $result[] = $fetchRow;
        
        return $result;
    }

}
?>