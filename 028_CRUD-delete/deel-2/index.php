<?php 
    
function __autoload($classname) {
    include_once ('../classes/'. $classname .'.php');
}
    $mStatus = false; // messages status
    $confirmBtn = false; // confirm btn status, to control if it's visibile
    $valuesToBind = array(':brouwer' => 'jo%');
    $valToDelete = '';

   
    try{

        $queryStr = 'SELECT * FROM brouwers
                     WHERE brouwers.brnaam 
                     LIKE :brouwer';

        //__connectie__//
        $msqlConn = new MsqlConnect('bieren', 'jolita', 'zN6br4fLYVJ8pSNy', $queryStr);

        
        //__query resultaten__//
        $brouwers = $msqlConn->query($queryStr, $valuesToBind);
        

        //__delete aktie__//
        if (isset($_POST['delete'])) {

            $mStatus = true;

            $confirmBtn = true;

            $valToDelete =  $_POST['delete'];

            Message::setMessage('Bent u zeker dat u deze datarij wil verwijderen?', 'warning');
        }  

        if (isset($_POST['ja'])) {
            
            $mStatus = true;

                $delQueryStr = 'DELETE FROM brouwers WHERE brouwernr = :brouwernr';
                $isDeleted = $msqlConn->insert_delete($delQueryStr, array(':brouwernr'=>$_POST['ja']));

                if ($isDeleted[0]) {
                    Message::setMessage( "Successfully deleted." , 'success');
                    header( "refresh:1.5; url=index.php" ); 
                    //header('Location: index.php');
                }
                else{
                    $message  =  "Something went wrong! Couldn't remove: " . $isDeleted[1];
                    Message::setMessage( $message , 'error');
                    header( "refresh:1.5; url=index.php" ); 
                }
                

        }          
   
    }
    catch ( PDOException $e ){
         Message::setMessages('Er ging iets mis: ' . $e->getMessage(), 'error' );
    }


    //___BUILD HTML___//

$headerArr = array('link' => 'header.php',
                             'data' => array('title' => 'CRUD delete | deel 2'));

$bodyArr = array('link' =>  'body.php',
                            'data' => array('title'         => 'CRUD delete | deel 2', 
                                            'messages'      => Message::getMessages(), 
                                            'mStatus'       => $mStatus,
                                            'valToDelete'   => $valToDelete,
                                            'brouwers'      => $brouwers[1],
                                            'thead'         => $brouwers[0],
                                            'delete'        => $confirmBtn));

$footerArr = array('link' => 'footer.html',
                             'data' => array('footerInfo' => 'Jolita Grazyte'));

$page = new View($headerArr, $bodyArr, $footerArr);

 ?>
   