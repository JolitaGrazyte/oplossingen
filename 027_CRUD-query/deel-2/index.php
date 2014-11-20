<?php 

$messageContainer = '';
$selectedBrouwer = false;
try
	{
		$dbLink = new PDO('mysql:host=localhost;dbname=bieren', 'jolita', 'zN6br4fLYVJ8pSNy');
		$queryStr = 'SELECT brouwernr, brnaam
                            FROM brouwers';


		$statement = $dbLink->prepare($queryStr);
		
		$statement->execute();

		$fetchRow = array();

		while ( $row = $statement->fetch(PDO::FETCH_ASSOC) )
		{
			$fetchRow[]	=	$row;
		}

        
        if (isset($_GET['brouwernr'])) {
  
            $selectQueryStr = 'SELECT bieren.naam, brouwers.brnaam 
                                FROM  bieren
                                INNER JOIN brouwers
                                ON bieren.brouwernr = brouwers.brouwernr
                                WHERE bieren.brouwernr = :bierNr';

            $statement2 = $dbLink->prepare($selectQueryStr);

            $statement2->bindValue(':bierNr', $_GET['brouwernr']);

            $statement2->execute();

            $fetchBieren = array();

            while ( $row = $statement2->fetch(PDO::FETCH_ASSOC) )
            {
                $fetchBieren[] =   $row;
                
            }

            $selectedBrouwer =  true;
    
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
         <title>CRUD query DEEL 2</title>
         <link rel="stylesheet" href="css/global.css">
     </head>
     <body>

     <h2>Bieren</h2>
     <?=$messageContainer;  ?>

     <form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
     <select name="brouwernr">
     <?php foreach ($fetchRow as $row): ?>
        <?php if ($row['brouwernr'] == $_GET['brouwernr']): ?>
         
        <option id="brouwernr" selected value="<?=$row['brouwernr'] ?>"><?=$row['brnaam'] ?></option>
     
     <?php else: ?>

        <option <option id="brouwernr" value="<?=$row['brouwernr'] ?>"><?=$row['brnaam'] ?></option>

    <?php endif ?>
    <?php endforeach ?>

     </select>
     <input type="submit" value='Geef alle bieren van brouwerij'/>

     </form>

<?php if ($selectedBrouwer): ?>
    <table>
        <thead>
        <tr>
        <?php foreach ($fetchRow as $key => $row): ?>
            <?php if ($row['brouwernr'] == $_GET['brouwernr']): ?>
         
        <th>Bieren van <?=$row['brnaam'] ?> </th>
     
     <?php endif ?>
        <?php endforeach ?>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($fetchBieren as $row): ?>
        <tr>
            <td>    <?=$row['naam']       ?>  </td>
        </tr>
        <?php endforeach ?>
        </tbody>
        <tfoot></tfoot>
     </table>
<?php endif ?>
     
     </body>
 </html>