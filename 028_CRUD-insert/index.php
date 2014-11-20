<?php 
$messageContainer = '';
try
	{
		if (isset($_POST['submit'])) {
		$dbLink = new PDO('mysql:host=localhost;dbname=bieren', 'jolita', 'zN6br4fLYVJ8pSNy');
		$queryStr = 'INSERT INTO brouwers(brnaam, adres, postcode, gemeente, omzet) VALUES (:brouwernaam, :adres, :postcode, :gemeente, :omzet)';


		$statement = $dbLink->prepare($queryStr);

			// foreach ($_POST as $value) {
			// 	if ($_POST['$value'] != $_POST['submit']) {
			// 		$statement->bindValue(':$value', $_POST['$value']);
			// 	}
				
			// }
		//$statement->bindValue(':brNaam', $_POST['brouwernaam']);
		//$statement->bindValue(':brAdres', $_POST['adres']);

			$statement->execute(array(	':brouwernaam' => $_POST['brouwernaam'], 
										':adres' => $_POST['adres'], 
										':postcode' => $_POST['postcode'],
										':gemeente' => $_POST['gemeente'],
										':omzet' => $_POST['omzet']));

			//$statement->execute();
	}
		
    }
	catch ( PDOException $e )
	{
		$messageContainer	=	'Er ging iets mis: ' . $e->getMessage();
	}


 ?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CRUD insert</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
         <h1>Voeg een brouwer toe</h1>
         <?=$messageContainer ?>

                    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                        <ul>
                            <li>
                                <label for="brouwernaam">Brouwernaam</label>
                                <input type="text" id="brouwernaam" name="brouwernaam">
                            </li>
                            <li>
                                <label for="adres">adres</label>
                                <input type="text" id="adres" name="adres">
                            </li>
                            <li>
                                <label for="postcode">postcode</label>
                                <input type="text" id="postcode" name="postcode">
                            </li>
                            <li>
                                <label for="gemeente">gemeente</label>
                                <input type="text" id="gemeente" name="gemeente">
                            </li>
                            <li>
                                <label for="omzet">omzet</label>
                                <input type="text" id="omzet" name="omzet">
                            </li>
                        </ul>
                        <input type="submit" name="submit">
                    </form>
    </body>
</html>