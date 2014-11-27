<?php 
function __autoload($classname) {
    include_once ('./classes/'. $classname .'.php');
}   
    $messagesStatus = false;
    $emptyFields = false;

if (empty($_POST['brouwernaam']) OR empty($_POST['adres']) OR empty($_POST['postcode']) OR empty($_POST['gemeente'])) {
    $emptyFields = true;

}

try
	{
		if (isset($_POST['submit']) && $emptyFields) {
                
                Message::setMessage( "You have to fill in all fields." , 'error');

                $messagesStatus = true;
            }
        elseif(isset($_POST['submit'])) {
            
                $messagesStatus = true;
           

$valuesToBind = array(  ':brouwernaam'  => $_POST['brouwernaam'], 
                        ':adres'        => $_POST['adres'], 
                        ':postcode'     => $_POST['postcode'],
                        ':gemeente'     => $_POST['gemeente'],
                        ':omzet'        => $_POST['omzet']);

//___query string__//
$queryStr = 'INSERT INTO brouwers(brnaam, adres, postcode, gemeente, omzet) 
                     VALUES (:brouwernaam, :adres, :postcode, :gemeente, :omzet)';


//___connecting to database___
$msqlConn = new MsqlConnect('bieren', 'jolita', 'zN6br4fLYVJ8pSNy', $queryStr);

//__inserting__//
$isSubmited = $msqlConn->insert_delete($queryStr, $valuesToBind);

//__checking if all went right__//
//__and giving a feedback__//
 if ($isSubmited[0]) {
                    Message::setMessage( "Successfully submited." , 'success');
                    header( "refresh:2; url=index.php" ); 
                }
                else{
                    $message  =  "Something went wrong! Couldn't submit: " . $isSubmited[1];
                    Message::setMessage( $message , 'error');
                }

	   }
		
    }
	catch ( PDOException $e )
	{
		 $message = 'Something went wrong! '.$e->getMessage();
         Message::setMessage($message, 'error');
	}

//___BUILD HTML___//

$headerArr = array('link' => 'header.php',
                             'data' => array('title' => 'CRUD insert'));

$bodyArr = array('link' =>  'body.php',
                            'data' => array('title' => 'CRUD insert', 'messages' => Message::getMessages(), 
                            'mStatus' => $messagesStatus));

$footerArr = array('link' => 'footer.html',
                             'data' => array('footerInfo' => 'Jolita Grazyte'));

$page = new View($headerArr, $bodyArr, $footerArr);


 ?>
