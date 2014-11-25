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
                Message::setMessage( "Successfully submited." , 'success');
                $messagesStatus = true;
            

		$dbLink = new PDO('mysql:host=localhost;dbname=bieren', 'jolita', 'zN6br4fLYVJ8pSNy');
		$queryStr = 'INSERT INTO brouwers(brnaam, adres, postcode, gemeente, omzet) 
                     VALUES (:brouwernaam, :adres, :postcode, :gemeente, :omzet)';


		$statement = $dbLink->prepare($queryStr);

		$statement->execute(array(	':brouwernaam' => $_POST['brouwernaam'], 
									':adres' => $_POST['adres'], 
									':postcode' => $_POST['postcode'],
									':gemeente' => $_POST['gemeente'],
									':omzet' => $_POST['omzet']));

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
