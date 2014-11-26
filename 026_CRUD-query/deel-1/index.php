<?php 

    $messageContainer = '';

    try{
		
        $dbLink = new PDO('mysql:host=localhost;dbname=bieren', 'jolita', 'zN6br4fLYVJ8pSNy');
        $bierNaam = 'du%';
        $brouwerNaam = '%a%';

		$queryString = 'SELECT  bieren.biernr, 
								bieren.naam,
                                brouwers.brnaam,
								bieren.brouwernr, 
								bieren.soortnr, 
								bieren.alcohol, 
								brouwers.adres,
								brouwers.postcode,
								brouwers.gemeente,
								brouwers.omzet
						FROM bieren
						INNER JOIN brouwers
						ON bieren.brouwernr = brouwers.brouwernr
						WHERE bieren.naam LIKE :bierNaam
                        AND brouwers.brnaam LIKE :brouwerNaam';

		$statement = $dbLink->prepare($queryString);
		$statement->bindValue(':bierNaam', $bierNaam);
        $statement->bindValue(':brouwerNaam', $brouwerNaam);
		$statement->execute();

		$fetchRow = array();

		while ( $row = $statement->fetch(PDO::FETCH_ASSOC))
		{
            $fetchRow[] = $row;

            $theadArr = array();

            foreach ($fetchRow[0] as $key => $value) 
            {
                $theadArr[] = $key;
            }
		}

	}
	catch ( PDOException $e ){
		$messageContainer	=	'Er ging iets mis: ' . $e->getMessage();
	}

 ?>
 <!doctype html>
 <html>
     <head>
         <meta charset="utf-8">
         <meta name="description" content="">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>CRUD query</title>
         <link rel="stylesheet" href="../css/style.css">
     </head>
     <body>

     <h2>Bieren die beginen met du</h2>
     <?=$messageContainer;  ?>
     <table>
     	<thead>
     	<tr>
        <th>#</th>
     	<?php foreach ($theadArr as $value): ?>
     		<th><?=$value ?></th>
     	<?php endforeach ?>
     	</tr>
     	</thead>
     	<tbody>
     	<?php foreach ($fetchRow as $indx => $row): ?>
     	<tr>
        <td> <?=($indx+1) ?> </td>
            <?php foreach ($row as  $value): ?>
                <td> <?=$value ?> </td>
            <?php endforeach ?>
     		<!-- <td>	<?=($indx+1) 			?>	</td>
     		<td>	<?=$row['biernr'] 		?>	</td>
     		<td>	<?=$row['naam'] 		?>	</td>
     		<td>	<?=$row['brnaam'] 		?>	</td>
     		<td>	<?=$row['brouwernr'] 	?>	</td>
     		<td>	<?=$row['soortnr'] 		?>	</td>
     		<td>	<?=$row['alcohol'] 		?>	</td>
     		<td>	<?=$row['adres'] 		?>	</td>
     		<td>	<?=$row['postcode'] 	?>	</td>
     		<td>	<?=$row['gemeente'] 	?>	</td>
     		<td>	<?=$row['omzet'] 		?>	</td> -->
     	</tr>
     	<?php endforeach ?>
     	</tbody>
     	<tfoot></tfoot>
     </table>
     </body>
 </html>