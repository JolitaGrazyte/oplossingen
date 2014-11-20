<?php 
    try{
        
        $dbLink = new PDO('mysql:host=localhost;dbname=bieren', 'jolita', 'zN6br4fLYVJ8pSNy');
        $bierNaam = 'j%';

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
                        WHERE brouwers.brnaam LIKE :bierNaam';

        $statement = $dbLink->prepare($queryString);
        $statement->bindValue(':bierNaam', $bierNaam);
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

        if (isset($_POST['delete'])) {
            $messageContainer = 'op submit gedrukt';

            $deleteQueryStr = 'DELETE FROM bieren WHERE brouwernr = :brouwernr';
            $delStatement = $dbLink->prepare($deleteQueryStr);
            $delStatement->bindValue(':brouwernr', $_POST['delete']);
            $delStatement->execute();
            
            header('Location: index.php');
        }

    }
    catch ( PDOException $e ){
        $messageContainer   =   'Er ging iets mis: ' . $e->getMessage();
    }

 ?>
 <!doctype html>
 <html>
     <head>
         <meta charset="utf-8">
         <meta name="description" content="">
         <meta name="viewport" content="width=device-width, initial-scale=1">
         <title>CRUD delete</title>
         <link rel="stylesheet" href="style.css">
     </head>
     <body>

     <h2>Overzicht van de bieren</h2>
     <?=$messageContainer;  ?>
     <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
     <table>
        <thead>
        <tr>
        <th>#</th>
        <?php foreach ($theadArr as $value): ?>
            <th><?=$value ?></th>
        <?php endforeach ?>
        <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($fetchRow as $indx => $row): ?>
        <tr>
        <td> <?=($indx+1) ?> </td>
            <?php foreach ($row as  $value): ?>
                <td> <?=$value ?> </td>
            <?php endforeach ?>
            <td><button name="delete" type="submit" value="<?=$row['brouwernr'] ?>"></button></td>
        </tr>
        <?php endforeach ?>
        </tbody>
        <tfoot></tfoot>
     </table>
     </form>
     </body>
 </html>