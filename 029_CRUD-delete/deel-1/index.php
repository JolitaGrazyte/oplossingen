<?php 

function __autoload($classname) {
    include_once ('../classes/'. $classname .'.php');
}
    $mStatus = false;

    try{
        
        $dbLink = new PDO('mysql:host=localhost;dbname=bieren', 'jolita', 'zN6br4fLYVJ8pSNy');

        $brouwer = 'jo%';

        $queryString = 'SELECT * FROM brouwers
                        WHERE brouwers.brnaam LIKE :brouwer';

        $statement = $dbLink->prepare($queryString);

        $statement->bindValue(':brouwer', $brouwer);

        $statement->execute();

        $brouwers = array();

        while ( $row = $statement->fetch(PDO::FETCH_ASSOC))
        {
            $brouwers[] = $row;

            $theadArr = array();

            foreach ($brouwers[0] as $key => $value) 
            {
                $theadArr[] = $key;
            }
        }

        if (isset($_POST['delete'])) {

                $mStatus = true;

                $deleteQueryStr = 'DELETE FROM brouwers WHERE brouwernr = :brouwernr';
                
                $delStatement = $dbLink->prepare($deleteQueryStr);

                $delStatement->bindValue( ':brouwernr', $_POST['delete'] );

                if ($delStatement->execute()) {
                    Message::setMessage('Successfully deleted.', 'success');

                }
                else {
                    $message  =  "Couldn't remove: " . $delStatement->errorInfo()[2];
                    Message::setMessage( $message, 'error' );
                        
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
                            'data' => array('title'     => 'CRUD delete', 'messages' => Message::getMessages(), 
                                            'mStatus'   => $mStatus,
                                            'brouwers'  => $brouwers,
                                            'thead'     => $theadArr ));

$footerArr = array('link' => 'footer.html',
                             'data' => array('footerInfo' => 'Jolita Grazyte'));

$page = new View($headerArr, $bodyArr, $footerArr);


 ?>
 