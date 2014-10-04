<!doctype html>
<html>
<?php 
$dieren = array('vos', 'wolf', 'haas', 'beer', 'tijger', 'aap', 'hond', 'kat', 'muis', 'olifant');

$_dieren[0] = 'vos';
$_dieren[1] = 'wolf';
$_dieren[2] = 'haas';
$_dieren[3] = 'beer';
$_dieren[4] = 'tijger';
$_dieren[5] = 'aap';
$_dieren[6] = 'hond';
$_dieren[7] = 'kat';
$_dieren[8] = 'muis';
$_dieren[9] = 'olifant';

$voertuigen = array('landvoertuigen'=>'fiets', 'auto', 'watervoertuigen' =>'boot', 'luchtvoertuigen' =>'vliegtuig', 'luchtballon');

$_voertuigen['landvoertuigen'] = array('fiets', 'auto');
$_voertuigen['watervoertuigen'] = array('boot');
$_voertuigen['luchtvoertuigen'] = array('vliegtuig', 'luchtballon');

$getallen = array(1, 2, 3, 4, 5);
$_getallen = array(5, 4, 3, 2, 1);
$uitkomst = $getallen[0]*$getallen[1]*$getallen[2]*$getallen[3]*$getallen[4];
$_uitkomst = array();

for ($i=0; $i < 5; $i++) { 
    $_uitkomst[] = $getallen[$i]+$_getallen[$i];
}
/*foreach ($getallen as $key => $value) {
   array_push($_uitkomst, ($getallen[$key]+$_getallen[$key]));
}
*/

$oneven = array();

    foreach($getallen as $key => $value)
{      
  if($getallen[$key]%2 != 0) 
   array_push($oneven, $getallen[$key]);
}    
 

 ?>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Opdracht Arrays Basis</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <h1>Opdracht Arrays Basis</h1>
        <h2>Deel 1</h2>
        <?=var_dump($dieren) ?>
        <?=var_dump($_dieren) ?>
        <?=var_dump($voertuigen) ?>
        <?=var_dump($_voertuigen) ?>

        <h2>Deel 2</h2>
        <p>Som van de getallen uit array 1: <?= $uitkomst ?></p>
        <p>Oneven:</p>
        <?=var_dump($oneven) ?>
        <p>De getallen van beide arrays met elkaar opgeteld:</p>
        <?=var_dump($_uitkomst) ?>


        </body>
        <script src="js/main.js"></script>
    </body>
</html>