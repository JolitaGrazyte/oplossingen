<?php 

class Brouwers{


    public static function getAllBrouwers( $msqlConn ){

        $queryStr  =   'SELECT brouwernr, brnaam
                        FROM  brouwers';

        $valToBind = array();

        $brouwers = $msqlConn->query( $queryStr, $valToBind );

        return $brouwers;
    }

}

 ?>