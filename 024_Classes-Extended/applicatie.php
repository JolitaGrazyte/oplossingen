<!doctype html>
<?php 

// we've writen this code where we need
function __autoload($classname) {
    $filename = "./classes/". $classname .".php";
    include_once($filename);
}


$okapi = new Animal('Zita', 'female', 70);
$hippo = new Animal('Rob', 'male', 80);
$gazelle = new Animal('Jackie', 'female', 100);
$lion1 = new Lion('Donna', 'female', 200, 'Kenia lion');
$lion2 = new Lion('Oscar', 'male', 250, 'Congo lion');
$zebra1 = new Zebra('Vanda', 'female', 100, 'Quagga');
$zebra2 = new Zebra('Luka', 'female', 80, 'Selous');


//$changeHealth = $okapi->changeHealth(-20);

$dieren = array();
$dieren[] = $okapi->getName().' is van het geslacht '.$okapi->getGender().' en heeft momenteel '.$okapi->changeHealth(-20).' levenspunten. Special move: '.$okapi->doSpecialMove().'.';
$dieren[] = $hippo->getName().' is van het geslacht '.$hippo->getGender().' en heeft momenteel '.$hippo->getHealth().' levenspunten. Special move: '.$hippo->doSpecialMove().'.';
$dieren[] = $gazelle->getName().' is van het geslacht '.$gazelle->getGender().' en heeft momenteel '.$gazelle->getHealth().' levenspunten. Special move: '.$gazelle->doSpecialMove().'.';
$dieren[] = 'De speciale move van '.$lion1->getName().' (soort: '.$lion1->getSpecies().'): '.$lion1->doSpecialMove().'.';
$dieren[] = 'De speciale move van '.$lion2->getName().' (soort: '.$lion2->getSpecies().'): '.$lion2->doSpecialMove().'.';
$dieren[] = 'De speciale move van '.$zebra1->getName().' (soort: '.$zebra1->getSpecies().'): '.$zebra1->doSpecialMove().'.';
$dieren[] = 'De speciale move van '.$zebra2->getName().' (soort: '.$zebra2->getSpecies().'): '.$zebra2->doSpecialMove().'.';


 ?>


<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Classes Extended</title>
        <link rel="stylesheet" href="css/style.css">

    </head>
    <body>
      <?php foreach ($dieren as $value): ?>
           <p><?=$value  ?></p>
      <?php endforeach ?>
    

    </body>
</html>