<?php 
    
function __autoload($classname) {
    include_once ('./classes/'. $classname .'.php');
}
    $valuesToBind = array(':brouwer' => 'j%');
    $valToDelete = false;
    $valToEdit = '';
    $toEdit = false;
    $admin_email = 'jolita@wgwstore.com';
    $colNames = false;
    $order = 'ASC';
    $limit = ' LIMIT 10';
    $colToOrderBy = 'bieren.biernr';


       if (isset($_GET['orderBy'])) {

        $orderByArr = explode('-', $_GET['orderBy']);
        $colToOrderBy = $orderByArr[0];

            
            if ($orderByArr[1] === 'DESC') {
                $order = 'ASC';
            }
            else{
                $order = 'DESC';
            }

        }


    try{

        //__make query__//
        $queryStr = 'SELECT bieren.biernr, bieren.naam, brouwers.brnaam ,soorten.soort, bieren.alcohol, brouwers.brouwernr
                    FROM bieren
                    INNER JOIN brouwers
                            ON bieren.brouwernr = brouwers.brouwernr
                    INNER JOIN soorten
                            ON bieren.soortnr = soorten.soortnr ORDER BY'.' '.$colToOrderBy.' '.$order.$limit;

        //__connectie__//
        $msqlConn = new MsqlConnect('bieren', 'jolita', 'zN6br4fLYVJ8pSNy', $queryStr);
        
        //__query resultaten__//
        $results = $msqlConn->query($queryStr, $valuesToBind);

        $colNames = array(  'biernr'     => 'Biernummer (PK)', 
                            'naam'       => 'Biernaam', 
                            'brnaam'     => 'Brouwernaam', 
                            'soort'      => 'Soort', 
                            'alcohol'    => 'Alcoholpercentage',
                            'brouwernr'  => 'Brouwernr(PK)' );

        //__delete aktie__//
        if (isset($_POST['delete'])) {

            $valToDelete =  $_POST['delete'];

            Message::setMessage('Bent u zeker dat u deze datarij wil verwijderen?', 'warning');
        }

           if (isset($_POST['ja'])) {

                $delQueryStr = 'DELETE FROM brouwers WHERE brouwernr = :brouwernr';
                $isDeleted = $msqlConn->insert_delete($delQueryStr, array(':brouwernr'=>$_POST['ja']));

                if ($isDeleted[0]) {
                    Message::setMessage( 'De datarij werd goed verwijderd.' , 'success');
                    header( "refresh:1.5; url=index.php" ); 
                    //header('Location: index.php');
                }
                else{
                    //$message  =  "Something went wrong! Couldn't remove: " . $isDeleted[1];
                    //Message::setMessage( $message , 'error');
                    Message::setMessage( 'De datarij kon niet verwijderd worden. 
                                         Probeer opnieuw of neem contact op 
                                         met de systeembeheerder wanneer deze fout blijft aanhouden. ', 'error');
                    $email = 'jolita@wgwstore.com';
                    //header( "refresh:5; url=index.php" ); 
                }
                

        }  

        if(isset($_POST['edit'])){

            $valToEdit = $_POST['edit'];

            $toEditQueryStr = 'SELECT * FROM brouwers WHERE brouwernr = :brouwernr';

            //__query resultaten__//
            $toEdit = $msqlConn->query($toEditQueryStr, array(':brouwernr' => $_POST['edit']));
        }



        if (isset($_POST['submit'])) {

            $queryStr = 'UPDATE brouwers
                         SET    brnaam = :brnaam, 
                                adres = :adres, 
                                postcode = :postcode, 
                                gemeente = :gemeente, 
                                omzet = :omzet
                         WHERE  brouwernr = :brouwernr';

            $valToBind = array( ':brnaam'       => $_POST['brnaam'], 
                                ':adres'        => $_POST['adres'], 
                                ':postcode'     => $_POST['postcode'],
                                ':gemeente'     => $_POST['gemeente'],
                                ':omzet'        => $_POST['omzet'],
                                ':brouwernr'    => $_POST['brouwernr'] );
            
            $isUpdated = $msqlConn->update($queryStr, $valToBind);

            if ($isUpdated[0]) {
                    Message::setMessage( "Aanpassing succesvol doorgevoerd.", 'success');
                    header( "refresh:2; url=index.php" ); 
                    //header('Location: index.php');
                }
                else{

                    // $message  =  "Something went wrong! Couldn't update: " . $isUpdated[1]; // gives the reason, why it failed
                    // Message::setMessage( $message , 'error');

                    Message::setMessage('Aanpassing is niet gelukt. 
                                         Probeer opnieuw of neem contact 
                                         op met de systeembeheerder wanneer deze fout blijft aanhouden. 
                                         <a class="contact" href="mailto:"'.$admin_email.'">jolita@wgwstore.com</a>', 'error');
                    $email = 'jolita@wgwstore.com';
                    //header( "refresh:5; url=index.php" ); 
                }
        }

} 

catch (PDOException $e) {
    
    $message = 'Sorry, failed! '.$e->getMessage();
    
    Message::setMessage($message, 'error');
    
}

//___BUILD HTML___//

$headerArr = array('link' => 'header.php',
                             'data' => array('title' => 'CRUD order by'));

$bodyArr = array('link' =>  'body.php',
                            'data' => array('title'         => 'CRUD order by', 
                                            'messages'      => Message::getMessages(),
                                            'colNames'      => $colNames,
                                            'bieren'        => $results[1],
                                            'valToDelete'   => $valToDelete,
                                            'valToEdit'     => $valToEdit,
                                            'order'         => $order,
                                            'toEdit'        => $toEdit[1][0]));


$footerArr = array('link' => 'footer.html',
                             'data' => array('footerInfo' => 'Jolita Grazyte'));

$page = new View($headerArr, $bodyArr, $footerArr);

 ?>