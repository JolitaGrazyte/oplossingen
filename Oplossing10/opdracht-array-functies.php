<!doctype html>
<html>
<?php 
//deel 1
	$dieren = array('vos', 'wolf', 'haas', 'beer', 'tijger');
	$hoeveel = count($dieren);
	$teZoekenDier = 'vos';
		if (in_array($teZoekenDier, $dieren)) $m = 'gevonden';
		else $m = 'niet gevonden';
	$message = ucfirst($teZoekenDier)." in array ".$m.".";
	
 ?>

 <?php 
 //deel 2
	$dieren = array('vos', 'wolf', 'haas', 'beer', 'tijger');
	$hoeveel = count($dieren);
	$teZoekenDier = 'vos';
		if (in_array($teZoekenDier, $dieren)) $m = 'gevonden';
		else $m = 'niet gevonden';
	$message = ucfirst($teZoekenDier)." in array ".$m.".";
	asort($dieren);
	$zoogdieren = array('zebra', 'olifant', 'giraffe' );
	$dierenLijst = array_merge($zoogdieren, $dieren);
 ?>

 <?php 
 //deel 3
	$numbers = array(8, 7, 8, 7, 3, 2, 1, 2, 4); 
	$uniqueResultaat = array_unique($numbers);
	asort($uniqueResultaat);

 ?>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht Array Functies</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <H2>Opdracht array functies: deel 1</H2>
        <p><?=$hoeveel ?></p>
        <p><?=$message ?></p>

        <H2>Opdracht array functies: deel 2</H2>
        <p><?=var_dump($dieren) ?></p>
        <p><?=var_dump($dierenLijst) ?></p>

        <H2>Opdracht array functies: deel 3</H2>
        <p><?=var_dump($uniqueResultaat) ?></p>

        <script src="js/main.js"></script>
    </body>
</html>