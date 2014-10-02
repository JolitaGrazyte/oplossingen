<!doctype html>
<html>
<?php 
	$deDag = '';
	$getal = 5;
	switch ($getal) {
		case '1':
			$deDag = 'Maandag';
			break;
		case '2':
			$deDag = 'Dinsdag';
			break;
		case '3':
			$deDag = 'Woensdag';
			break;
		case '4':
			$deDag = 'Donderdag';
			break;
		case '5':
			$deDag = 'Vrijdag';
			break;
		case '6':
			$deDag = 'Zaterdag';
			break;
		case '7':
			$deDag = 'Zondag';
			break;
		
		default:
			# code...
			break;
	}
	$deDagFirstLower = lcfirst($deDag);
 ?>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht switch</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <h1>Opdracht switch</h1>
        <h2><?=$deDagFirstLower ?></h2>
        <script src="js/main.js"></script>
    </body>
</html>