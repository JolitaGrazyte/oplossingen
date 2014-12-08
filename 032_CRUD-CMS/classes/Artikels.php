<?php 

class Artikels{

	public static function getArtikels( $msqlConn ){

		$queryStr = 'SELECT * FROM artikels WHERE is_archived = 0';

        $valToBind = array();

        $results = $msqlConn->query($queryStr, $valToBind);

        $artikels = $results['data'];

        return $artikels;

	}


    public static function createArtikel($msqlConn, $valToBind){

            $queryStr = 'INSERT INTO artikels (title, artikel, kernwoorden)
                         VALUES (:title, :artikel, :kernwoorden)';
    
            $isSubmited = $msqlConn->update( $queryStr, $valToBind );

        return $isSubmited;

    }

    public static function updateArtikel($msqlConn, $valToBind){

        $queryStr = 'UPDATE artikels

                     SET    title       = :title, 
                            artikel     = :artikel, 
                            kernwoorden = :kernwoorden

                     WHERE  id = :artikelID';
    
        $isUpdated = $msqlConn->update( $queryStr, $valToBind );

        return $isUpdated;

    }

}

 ?>