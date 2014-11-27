<?php 

function __autoload($classname) {
    include_once ('../classes/'. $classname .'.php');
}

    $valuesToBind = array(':brouwer' => 'jo%');

    try{

         $queryStr = 'SELECT * FROM brouwers
                      WHERE brouwers.brnaam 
                      LIKE :brouwer';

        //__connectie__//
        $msqlConn = new MsqlConnect('bieren', 'jolita', 'zN6br4fLYVJ8pSNy', $queryStr);

        
        //__query resultaten__//
        $brouwers = $msqlConn->query($queryStr, $valuesToBind);
        

        if (isset($_POST['delete'])) {

                header('Location: index.php');


                $delQueryStr = 'DELETE FROM brouwers WHERE brouwernr = :brouwernr';
                $isDeleted = $msqlConn->insert_delete($delQueryStr, array(':brouwernr'=>$_POST['delete']));

                if ($isDeleted[0]) {
                    Message::setMessage( "Successfully deleted." , 'success');
                    header( "refresh:1.5; url=index.php" ); 
                }
                else{
                    $message  = "Something went wrong! Couldn't remove: " . $isDeleted[1]; //MOET HERZIEN WORDEN GEEFT GEEN MESSAGE TERUG
                    Message::setMessage( $message , 'error');
                }
        }

    }
    catch ( PDOException $e ){
            Message::setMessages('Er ging iets mis: ' . $e->getMessage(), 'error' );
    }

    //___BUILD HTML___//

$headerArr = array('link' => 'header.php',
                             'data' => array('title' => 'CRUD delete'));

$bodyArr = array('link' =>  'body.php',
                            'data' => array('title'     => 'CRUD delete', 
                                            'messages' => Message::getMessages(), 
                                            'brouwers'  => $brouwers[1],
                                            'thead'     => $brouwers[0] ));

$footerArr = array('link' => 'footer.html',
                             'data' => array('footerInfo' => 'Jolita Grazyte'));

$page = new View($headerArr, $bodyArr, $footerArr);


 ?>
 