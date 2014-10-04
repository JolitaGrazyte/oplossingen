<!doctype html>
<html>

<?php 
function berekenSom($getal1, $getal2){
	$resultaat = $getal1 + $getal2;
	return $resultaat;
}
//$res = berekenSom(9, 5);

function vermenigvuldig($getal1, $getal2){
	$resultaat = $getal1 * $getal2;
	return $resultaat;
}

function isEven($getal){
	if ($getal%2 == 0) $resultaat = "true";
	else $resultaat = "false";
	return $resultaat;
}
function stringBewerkingen($string){
	$resultaat = strtoupper($string).' - '.strlen($string).' letters lang.';
	return $resultaat;
}

function stringBewerkingen2($string){
	$uppercase = strtoupper($string);
	$stringLengte = strlen($string);
	$someText = ' letters lang.';
    return array($uppercase,' - ',$stringLengte, $someText);
}

//DEEL 2

function drukArrayAf($array){
	$ar = array();
foreach ($array as $value) {
	array_push($ar, $value);
}
return $ar;
}

/*function validateHtmlTag($html){

}
*/
 ?>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht Functies</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
    <h1>Opdracht Functies</h1>
    <h2>Deel 1</h2>
    <p>De som van twee getallen is: <?=berekenSom(2, 5) ?></p>
    <p>Het product van twee getallen is: <?=vermenigvuldig(2, 5) ?></p>
    <p>Het getal is even: <?=isEven(7) ?></p>
    <p>Het langste Engelstalige woord is: <?=stringBewerkingen(pneumonoultramicroscopicsilicovolcanoconiosis) ?></p>
    <p>Het langste Engelstalige woord is:  
    <?php $getInfo = stringBewerkingen2(pneumonoultramicroscopicsilicovolcanoconiosis); ?>
    <?php for ($i=0; $i < sizeof($getInfo); $i++): ?>
    	<?php	echo $getInfo[$i]; ?>
    <?php endfor; ?>
    </p>

     <h2>Deel 2</h2>

<?php  $planeten = array('Mercurius', 'Venus', 'Aarde', 'Mars', 'Jupiter', 'Saturnus', 'Urnanus', 'Neptunus'); ?>
<?php $voertuigen = array('landvoertuigen'=>'fiets', 'auto', 'watervoertuigen' =>'boot', 'luchtvoertuigen' =>'vliegtuig', 'luchtballon'); ?>
<?php  $ar = drukArrayAf($voertuigen); ?>
<?php  for ($i=0; $i < sizeof($ar); $i++): ?>
	<?php  echo 'Zonnestelsel ['.$i.'] '. $ar[$i].'</br>'; ?>
<?php endfor; ?>


        <script src="js/main.js"></script>
    </body>
</html>