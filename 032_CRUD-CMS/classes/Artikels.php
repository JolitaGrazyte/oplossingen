<?php 

class Artikels{

	public static function getArtikels(){

		$queryStr = 'SELECT * FROM artikels WHERE is_archived = 0';

		$msqlConn = new MsqlConnect( 'CRUD_CMS', 'jolita', 'zN6br4fLYVJ8pSNy');

        $valToBind = array();

        $results = $msqlConn->query($queryStr, $valToBind);

        $artikels = $results['data'];

        return $artikels;

	}


    public static function createArtikel($valToBind){

        $msqlConn = new MsqlConnect( 'CRUD_CMS', 'jolita', 'zN6br4fLYVJ8pSNy');

            $queryStr = 'INSERT INTO artikels (title, artikel, kernwoorden)
                         VALUES (:title, :artikel, :kernwoorden)';
    
            $isSubmited = $msqlConn->update( $queryStr, $valToBind );

        return $isSubmited;


    }

    public static function updateArtikel($valToBind){

        $msqlConn = new MsqlConnect( 'CRUD_CMS', 'jolita', 'zN6br4fLYVJ8pSNy');

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