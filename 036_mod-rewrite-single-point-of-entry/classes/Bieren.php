<?php 

class Bieren{

    private $msqlConn;

    public function __construct(){

        $this->msqlConn = new MsqlConnect('bieren', 'jolita', 'zN6br4fLYVJ8pSNy');

    }

	public static function overview( $msqlConn , $valToBind, $colToOrderBy, $order,  $limit ){
        
        $selectQueryStr  = 'SELECT bieren.biernr, 
                                   bieren.naam, 
                                   brouwers.brnaam,
                                   soorten.soort, 
                                   bieren.alcohol, 
                                   brouwers.brouwernr

                             FROM  bieren

                             INNER JOIN brouwers
                                ON bieren.brouwernr = brouwers.brouwernr

                             INNER JOIN soorten
                                ON bieren.soortnr = soorten.soortnr

                             WHERE bieren.brouwernr = :val 
                             ORDER BY'.' '.$colToOrderBy.' '.$order.$limit;

        $bierenOverzicht = $msqlConn->query( $selectQueryStr, $valToBind );

        $bierenOverzicht['colNames'] = array(   'biernr'     => 'Biernummer (PK)', 
                                                'naam'       => 'Biernaam', 
                                                'brnaam'     => 'Brouwernaam', 
                                                'soort'      => 'Soort', 
                                                'alcohol'    => 'Alcoholpercentage',
                                                'brouwernr'  => 'Brouwernr(PK)' );

        return $bierenOverzicht;

	}

    public static function insert( $msqlConn, $valToBind ){

        $queryStr = 'INSERT INTO bieren ( biernr, naam, brnaam, soort, alcohol, brouwernr )
                     VALUES ( :biernr :naam, :brnaam, :soort, :alcohol, :brouwernr )';
    
        $isSubmited = $msqlConn->update( $queryStr, $valToBind );

        return $isSubmited;

    }

    public static function delete( $msqlConn, $valToBind ){

        $queryStr = 'DELETE FROM bieren WHERE brouwernr = :brouwernr';

        $isDeleted = $msqlConn->update( $queryStr, $valToBind );

        return $isDeleted;
    }

    public static function update( $msqlConn, $valToBind ){

        $queryStr = 'UPDATE bieren
                     SET    naam      = :naam
                     WHERE  brouwernr   = :brouwernr';
    
        $isUpdated = $msqlConn->update( $queryStr, $valToBind );

        return $isUpdated;

    }

}

 ?>