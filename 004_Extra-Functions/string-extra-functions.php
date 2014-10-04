<!doctype html>
<?php 

$fruit = 'kokosnoot';
$fruitLengte = strlen($fruit);
$eersteO = strpos($fruit, "o", 1);
$fruitUpper = strtoupper($fruit);

$_fruit = 'ananas';
$laatsteA = strpos($_fruit, "a", 3);

$lettertje = "e";
$cijfertje = '3';
$langsteWoord = 'zandzeepsodemineralenwatersteenstralen';
$vervang = str_replace($lettertje, $cijfertje, $langsteWoord);
 ?>

<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Deel 1</h2>
<p><?= $fruitLengte ?></p>
<p><?= $eersteO ?></p>

<h2>Deel 2</h2>
<p><?= $laatsteA ?></p>
<p><?= $fruitUpper ?></p>

<h2>Deel 3</h2>
<p><?= $vervang ?></p>

    </body>
</html>