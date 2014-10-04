<!doctype html>
<?php  
$voornaam = 'Jolita';
$naam = 'Grazyte';
$volledigeNaam = $voornaam." ".$naam;
$lengte = strlen($volledigeNaam);
?>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
   <p><?= $volledigeNaam ?></p>  
   <p><?= $lengte ?></p>   

    </body>
</html>