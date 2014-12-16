<?php 

class Artikels{

	public static function getArtikels( $msqlConn ){

		$queryStr = 'SELECT * FROM artikels WHERE is_archived = 0 ORDER BY datum DESC' ;

        $valToBind = array();

        $results = $msqlConn->query($queryStr, $valToBind);

        $artikels = $results['data'];

        return $artikels;

	}

    public static function getArtikelsByKeyword( $msqlConn, $valToBind ){

        $queryStr = 'SELECT * FROM artikels WHERE artikel LIKE :keyword' ;    

        $results = $msqlConn->query($queryStr, $valToBind);

        $artikels = $results['data'];

        return $artikels;

    }

    public static function getArtikelsByDate( $msqlConn, $valToBind ){

        $queryStr = 'SELECT * FROM artikels WHERE datum LIKE :datum' ;    

        $results = $msqlConn->query($queryStr, $valToBind);

        $artikels = $results['data'];

        return $artikels;

    }


    public static function createArtikel($msqlConn, $valToBind){

            $queryStr = 'INSERT INTO artikels (title, artikel, kernwoorden, datum)
                         VALUES (:title, :artikel, :kernwoorden, :datum)';
    
            $isSubmited = $msqlConn->update( $queryStr, $valToBind );

        return $isSubmited;

    }

    public static function updateArtikel($msqlConn, $valToBind){

        $queryStr = 'UPDATE artikels

                     SET    title       = :title, 
                            artikel     = :artikel, 
                            kernwoorden = :kernwoorden,
                            datum       = :datum 

                     WHERE  id = :artikelID';
    
        $isUpdated = $msqlConn->update( $queryStr, $valToBind );

        return $isUpdated;

    }

}

 ?>